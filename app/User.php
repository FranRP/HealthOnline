<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    public function role() 
    {
        return $this->belongsTo(Role::class);
    }*/

    public function roles() 
    {
        return $this->belongsToMany(Role::class, 'assigned_roles');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function hasRoles(array $roles)
    {

        return $this->roles->pluck('name')->intersect($roles)->count();
        /*
        foreach ($roles as $role) 
        {

            
            foreach ($this->roles as $userRole) 
            {
                if ($userRole->name === $role)
                {
                    return true;
                }
            }
            
        }
        */

        return false;

        /*
        foreach ($roles as $role) 
        {
            if ($this->role === $role)
            {
                return true;
            }
        }

        return false;
        */

    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }
}
