<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\User;

class UserComposer
{
    public $all_user_count ;
    public $verified_user_count ;
    public $verified_external_user_count ;
    public $external_user_count ;

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->all_user_count = User::all()->count();
        $this->verified_user_count = User::where('is_active', 1 )->count();
        $this->verified_external_user_count = User::where(['is_active'=> 1,'user_type' => 'external' ])->count();
        $this->external_user_count = User::where('user_type', 'external' )->count();
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'all_user_count' => $this->all_user_count ,
            'external_user_count' => $this->external_user_count ,
            'verified_external_user_count' => $this->verified_external_user_count ,
        ] );


    }
}