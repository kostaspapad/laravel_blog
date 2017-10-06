<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
        // Table name
        protected $table = 'posts';
        
        // Primary key
        protected $primaryKey = 'id';
    
        // Timestamps
        public $timestamps = true;

        // A single post belongsTo the user
        public function user(){
            return $this->belongsTo('App\User');
        }
}
