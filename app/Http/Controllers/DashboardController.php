<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Dashboard must use the User controller
use App\User;

class DashboardController extends Controller
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
        /*
         * Adds create permission middleware to the routes create and store only. 
         * If the user tries to access either create or store routes, the middleware
         * will check to see if the user has the required authorization. If the user
         * does not have access, a 403 exception will be thrown.
         */
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
         
         /*
          * Adds edit permission middleware to routes edit and update. 
          * Only users with edit and update permissions will be able to
          * access these routes.
          */
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]); 
         
         /*
          * Add the delete permission middleware to routes show and delete.
          * Only users with show and delete permissions will be able to access
          * these routes.
          */
        $this->middleware('permission:delete', ['only' => ['show', 'delete']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts', $user->posts);
    }
}
