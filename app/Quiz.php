<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $dates = ['startDate', 'endDate'];

    public function class(){
        return $this->belongsTo('App\Classes');
    }
}
