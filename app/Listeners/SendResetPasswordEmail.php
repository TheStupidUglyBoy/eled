<?php

namespace App\Listeners;

use App\Events\ResetUserPasswordEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\user_forgetpassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SendResetPasswordEmail
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
     * @param  ResetUserPasswordEvent  $event
     * @return void
     */
    public function handle(ResetUserPasswordEvent $event)
    {
        $user  = $event->user ;
        $email = $user->email ;

        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);
        $url = route('user.password_verify', [$token, urlencode($email)] );
        Mail::to($email)->send(new user_forgetpassword($user,$url));
    }
}
