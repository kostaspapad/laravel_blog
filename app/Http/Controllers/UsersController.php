<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // Select all and order by
        $users = User::orderBy('created_at','desc')->paginate(10);

        return view('users.index')->with('users', $users);

    }

    public function show($id)
    {
        $user = User::find($id);

        return view('users.show')->with('user', $user);
    }
}
