<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
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

    public function index(){
        $title = 'This blog is';
        //1. Me to compact stelno vars sto view
        #return view('pages.index', compact('title'));
        
        //2. Me to -> pernao pali metavlites. Fenete pio wraio
        // kalitero gia pinakes
        return view('pages.index')->with('title', $title);
    }
    
    public function about(){
        $title = 'About us!';
        return view('pages.about')->with('title', $title);
    }
}
