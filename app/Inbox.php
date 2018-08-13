<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{

	protected $fillable = [
        'asunto', 'body',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
