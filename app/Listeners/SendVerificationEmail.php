<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\UserRegisterEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\user_registration_validation;

class SendVerificationEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisterEvent  $event
     * @return void
     */
    public function handle(UserRegisterEvent $event)
    {
        $email =  $event->user->email ;
        $user = $event->user;
        Mail::to($email)->send(new user_registration_validation($user));
    }

    
}
