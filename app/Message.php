<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //Por defecto cogerá messages
    //SI quieres asignar otra tabla usaremos: protected $table = 'nombre_tabla';

    protected $fillable = ['name','email','mensaje'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }



    public function tags()
    {
    	return $this->morphToMany(Tag::class,'taggable');
    }
}
