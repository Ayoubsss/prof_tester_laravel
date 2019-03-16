<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function teacher(){
        return $this->belongsTo('App\Teacher');
    }

    public function quizzes(){
        return $this->hasMany('App\Quiz');
    }

    public function activeQuizzes(){
        return $this->hasMany('App\Quiz')->where('status', true);
    }

    public function studentsRequests(){
        return $this->belongsToMany('App\Student', 'student_join_reqs')->withPivot('id','state');
    }

}
