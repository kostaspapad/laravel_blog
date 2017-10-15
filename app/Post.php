<?php

namespace App;
use Jcc\LaravelVote\CanBeVoted;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CanBeVoted;
    
    // Table name
    protected $table = 'posts';
    
    // Primary key
    protected $primaryKey = 'id';

    
    protected $vote = User::class;

    // Timestamps
    public $timestamps = true;

    public function getPost(){
        return $this;
    }
    // A single post belongsTo the user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
