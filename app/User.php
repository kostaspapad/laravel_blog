<?php

namespace App;

use Jcc\LaravelVote\Vote;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Vote;
    use Notifiable;
    
    // use SoftDeletes, EntrustUserTrait {
    //     SoftDeletes::restore insteadof EntrustUserTrait;
    //     EntrustUserTrait::restore insteadof SoftDeletes;
    // }
    // If you are not using soft deletes, then you can use the traits the normal way.
    use EntrustUserTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getRankId(){
        return $this->rank_id;
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function ranks(){
        return $this->hasOne('App\Rank');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }
}


