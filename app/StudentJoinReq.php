<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentJoinReq extends Model
{
    protected $fillable = ['student_id', 'classes_id'];

    public $timestamps = false;
}
