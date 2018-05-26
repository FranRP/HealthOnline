<?php

namespace App\Policies;

use App\User;
use App\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability) 
    {
        if ($user->hasRoles(['admin'])) {
            return true;
        }
    }

    public function destroy(User $authUser, User $user) 
    {
        return $authUser->id === $user->id;
        
    }
}
