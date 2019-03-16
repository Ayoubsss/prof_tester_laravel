<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function classes()
    {
        return $this->hasMany('App\Classes');
    }

}
