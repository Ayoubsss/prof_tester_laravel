<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes;
use App\Student;

class QuizAttempts extends Model
{
    protected $table = 'student_attempts';
    protected $fillable = ['student_id', 'quiz_id'];

    public $timestamps = false;

    public function _class(){
        return $this->hasOne('App\Classes');
    }

    public function _student(){
        return $this->hasOne('App\Student');
    }
}
