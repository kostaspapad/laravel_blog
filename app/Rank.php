<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'ranks';
    protected $fillable = ['rank', 'display_rank', 'description'];

     // A single rank belongsTo the user
     public function user(){
        return $this->belongsTo('App\User');
    }
}
