<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function classJoinRequests(){
        return $this->belongsToMany('App\Classes', 'student_join_reqs')->withPivot('id', 'state');
    }

    public function classes(){
        return $this->belongsToMany('App\Classes');
    }
}
