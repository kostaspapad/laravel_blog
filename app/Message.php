<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['user_id', 'profile_id', 'title', 'body'];

    public function getUserId(){
        return $this->user_id;
    }
    
    public function getProfileId(){
        return $this->profile_id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getBody(){
        return $this->body;
    }
    
    // A single message belongsTo the user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
