<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Student;
use App\Teacher;

class User extends Authenticatable
{
    use Notifiable;

    public static $type = 0;

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


    // public function set()
  

    public function updateType(){

        if( !($this->type == 1 || $this->type == 2) )
        {
            if($this->hasOne('App\Student')->count() == 1)
                $this->type = 1;
            else if($this->hasOne('App\Teacher')->count() == 1)
                $this->type = 2;
        }

    }

    public function getTeacher()
    {

        return $this->hasOne('App\Teacher');
    }

    public function getStudent()
    {

        return $this->hasOne('App\Student');
    }

    
}
