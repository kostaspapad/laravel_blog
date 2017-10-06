<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['type','notifiable_id','notifiable_type','data','read_at','created_at','updated_at','category','sender','active'];
}
