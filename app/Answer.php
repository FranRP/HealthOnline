<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function question()
    {
    	return $this->belongsTo('App\Question');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function reports()
    {
        return $this->morphOne(Report::class, 'reportable');
    }
}
