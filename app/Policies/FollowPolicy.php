<?php

namespace App\Policies;

use App\User;
use App\Follow;
use Illuminate\Auth\Access\HandlesAuthorization;

class FollowPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create follows.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id;
    }


    /**
     * Determine whether the user can delete the follow.
     *
     * @param  \App\User $user
     * @param  \App\Follow $follow
     * @return mixed
     */
    public function delete(User $user, Follow $follow)
    {
        return $user->slug == $follow->followed_slug;
    }

}
