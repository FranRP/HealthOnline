<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function note() 
    {
    	return $this->hasOne(Note::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function tags()
    {
    	return $this->morphToMany(Tag::class,'taggable');
    }

    public function reports()
    {
        return $this->morphOne(Report::class, 'reportable');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
