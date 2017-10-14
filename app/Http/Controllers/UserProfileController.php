<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);
        return view('users.profile.show')->with('user', $user);
    }


}
