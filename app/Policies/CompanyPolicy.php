<?php

namespace App\Policies;

use App\Company;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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
        return $user->IsAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function view(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
        if( is_null($user->company)   ){
            return true ;
        }
        return  false ;
        
    }

    public function admin_create(User $user)
    {
        return $user->IsAdmin();
    }

    public function update(User $user, Company $company)
    {
        return $user->IsAdmin();
    }


    public function delete(User $user, Company $company)
    {
        return $user->IsAdmin();
    }

    public function approveCompany(User $user, Company $company)
    {
        return $user->IsAdmin();
    }
}
