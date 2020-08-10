<?php

namespace App\Policies;

use App\Tip;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tip  $tip
     * @return mixed
     */
    public function view(User $user, Tip $tip)
    {
        return $user->id === $tip->user_id || $user->allowAdminEditor();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tip  $tip
     * @return mixed
     */
    public function update(User $user, Tip $tip)
    {
        return $user->id === $tip->user_id || $user->allowAdminEditor();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tip  $tip
     * @return mixed
     */
    public function delete(User $user, Tip $tip)
    {
        //only admin and owner can perform deletion
        return $user->id === $tip->user_id || $user->IsAdmin();
    }
}
