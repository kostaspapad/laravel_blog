<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use \Waavi\Sanitizer\Sanitizer;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use App\Notifications\NewPrivateMessage;

class MessagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        /*
        * Blocks guests from using the controllers views.
        */
        $this->middleware('auth');
    }

    public function index(){
        $messages = Message::orderBy('created_at','desc')->paginate(10);
        
        return view('messages.index')->with('messages', $messages);
    }
    
    public function store(Request $request){
        
        $senderID = $request->query->get('user_sender_id');
        $receiverID = $request->query->get('user_receiver_id');
        
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
       
        // Sanitize with waafi
        $data = [
            'user_sender_id' => $senderID,
            'user_receiver_id' => $receiverID,
            'title'    =>  $request->request->get('title'),
            'body'     =>  $request->request->get('body'),
        ];

        $filters = [
            'title'    =>  'trim|escape|capitalize',
            'body'     =>  'trim|escape|capitalize',
        ];

        $sanitizer  = new Sanitizer($data, $filters);
        $sanitizedData = $sanitizer->sanitize();
        
        $message = new Message();

        $message->title = $sanitizedData['title'];
        $message->body = $sanitizedData['body'];

        $message->user_sender_id = $sanitizedData['user_sender_id'];
        $message->user_receiver_id = $sanitizedData['user_receiver_id'];

        $message->save();

        // Notify the target user
        User::find($receiverID)->notify(new NewPrivateMessage($message));
        
        // Get the last notification id for the target user
        $lastNotificationId = User::find($receiverID)->notifications->first()->id;
        
        // Prepare data for elasticsearch. Must be done after the notification has been
        // inserted to database.
        $elasticsearchData = [
            'body' => [
                'user_sender_id' => $senderID,
                'user_receiver_id' => $receiverID,
                'notification_id' => $lastNotificationId,
                'username_sender' => User::find($senderID)->name,
                'username_receiver' => User::find($receiverID)->name,
                'email_sender' => User::find($senderID)->email,
                'email_receiver' => User::find($receiverID)->email,
                'title' => $message->title,
                'body' => $message->body
            ],
            'index' => 'blog',
            'type' => 'message',
            // 'id' => $message->user_sender_id,
        ];
        
        //dd($elasticsearchData);
        // Insert post elasticsearchData to elasticsearch
        $client = ClientBuilder::create()->build();
        $return = $client->index($elasticsearchData);
        
        return redirect('/users/'.$receiverID)->with('success', 'Message sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        
        return view('messages.show')->with('message', $message);    
    }

    
}
