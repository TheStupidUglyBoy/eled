<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use Auth ;

class NotificationComposer
{
    public $unread_notification_count ;

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        if( Auth::check() ){
            $this->unread_notification_count  =  Auth::user()->unreadNotifications->count() ;
        }
        

        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('unread_notification_count', $this->unread_notification_count  );
        

    }
}