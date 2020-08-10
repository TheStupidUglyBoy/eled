<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.user.create','admin.user.edit'], 'App\Http\View\Composers\RoleComposer');
        View::composer(['admin.user.create','admin.user.edit'] , 'App\Http\View\Composers\CompanyComposer');

        View::composer(
            ['components.home.navigation-home','components.admin.top-navigation-admin'], 
            'App\Http\View\Composers\NotificationComposer'
        );

        View::composer('admin.dashboard.index' , 'App\Http\View\Composers\UserComposer');

        View::composer([
            'admin.post.create',
            'admin.post.edit',
            'components.home.sidebar-home',
            'home.post.create',
            'home.post.edit'
        ] , 'App\Http\View\Composers\CategoryComposer');

        View::composer('components.home.sidebar-home' , 'App\Http\View\Composers\TagComposer');


        View::composer(
            ['components.home.sidebar-home','components.home.footer-home','home.index','admin.dashboard.index'] , 
            'App\Http\View\Composers\PostComposer'
        );
    }
}
