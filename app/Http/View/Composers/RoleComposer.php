<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\Role;

class RoleComposer
{
    public $roles ;

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->roles  = Role::all()->pluck('name','id');
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('get_roles_from_composer', $this->roles  );

    }
}