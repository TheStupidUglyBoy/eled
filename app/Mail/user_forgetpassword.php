<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class user_forgetpassword extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('example@example.com')
                    ->with([  'URL' => $this->url  ])
                    ->subject("Reset Password Email")
                    ->markdown('emails.users.UserResetPassword');
    }
}
