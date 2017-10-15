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
                'message_id' => $message->id,
                'message_body' => $message->body,
                'message_notification_id' => $lastNotificationId,
                'message_receiver' => [
                    'message_email_receiver' => User::find($receiverID)->email,
                    'message_user_receiver_id' => $receiverID,
                    'message_username_receiver' => User::find($receiverID)->name
                ],
                'message_sender' => [
                    'message_email_sender' => User::find($senderID)->email,
                    'message_user_sender_id' => $senderID,
                    'message_username_sender' => User::find($senderID)->name
                ],
                'message_datetime' => [
                    'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $message->updated_at->format('Y-m-d H:i:s'),
                ],
                'message_title' => $message->title,
            ],
            'index' => 'blog',
            'type' => 'message',
            'id' => $message->id
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
