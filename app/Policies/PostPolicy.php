<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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
     * @param  \App\post  $post
     * @return mixed
     */
    public function view(User $user, post $post)
    {
        return $user->id === $post->user_id || $user->allowAdminEditor();
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
     * @param  \App\post  $post
     * @return mixed
     */
    public function update(User $user, post $post)
    {
        return $user->id === $post->user_id || $user->allowAdminEditor();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\post  $post
     * @return mixed
     */
    public function delete(User $user, post $post)
    {
        return $user->id === $post->user_id || $user->IsAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\post  $post
     * @return mixed
     */
    public function restore(User $user, post $post)
    {
        return $user->id === $post->user_id || $user->IsAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\post  $post
     * @return mixed
     */
    public function forceDelete(User $user, post $post)
    {
        return $user->id === $post->user_id || $user->IsAdmin();
    }

    public function approvePost(User $user, post $post)
    {
        return $user->allowAdminEditor();
    }

    public function preview(User $user, post $post)
    {
        return $user->id === $post->user_id || $user->allowAdminEditor();
    }

    //this is for user in front end to see he can only update its draft post after creation of post
    public function HomePostUpdate(User $user, post $post)
    {
        if( $post->getAttributes()['is_active'] == 0   ){
            return $user->id === $post->user_id ;
        }else{
            return  false ;
        }
    }
}
