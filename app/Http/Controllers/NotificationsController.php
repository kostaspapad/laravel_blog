<?php

namespace App\Http\Controllers;

use App\UserNotification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
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

    public function index($notificationId)
    {
        $userNotification = UserNotification::find($notificationId);
        
        return view('usernotifications.index')->with('userNotification', $userNotification); 
    }

    /**
     * delete a specific notification
     *
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $user = \Auth::user();
        $notification = $user->notifications()->where('id',$id)->first();
        if ($notification)
        {
            $notification->delete();
            
        }
        else
            return back()->withErrors('we could not found the specified notification');
    }
}
