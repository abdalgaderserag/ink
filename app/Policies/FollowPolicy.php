<?php

namespace App\Policies;

use App\User;
use App\Follow;
use Illuminate\Auth\Access\HandlesAuthorization;

class FollowPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the follow.
     *
     * @param  \App\User  $user
     * @param  \App\Follow  $follow
     * @return mixed
     */
    public function view(User $user, Follow $follow)
    {
        //
    }

    /**
     * Determine whether the user can create follows.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the follow.
     *
     * @param  \App\User  $user
     * @param  \App\Follow  $follow
     * @return mixed
     */
    public function update(User $user, Follow $follow)
    {
        //
    }

    /**
     * Determine whether the user can delete the follow.
     *
     * @param  \App\User  $user
     * @param  \App\Follow  $follow
     * @return mixed
     */
    public function delete(User $user, Follow $follow)
    {
        //
    }

    /**
     * Determine whether the user can restore the follow.
     *
     * @param  \App\User  $user
     * @param  \App\Follow  $follow
     * @return mixed
     */
    public function restore(User $user, Follow $follow)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the follow.
     *
     * @param  \App\User  $user
     * @param  \App\Follow  $follow
     * @return mixed
     */
    public function forceDelete(User $user, Follow $follow)
    {
        //
    }
}
