<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Support\Facades\URL;

class user_registration_validation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
                    ->with([  'URL' => $this->generate_url()  ])
                    ->subject("Verify User Registration Email")
                    ->markdown('emails.users.RegistrationValidation');
    }

    public function generate_url()
    {
        return URL::temporarySignedRoute(
            'verify', now()->addMinutes(10), ['user' => $this->user->id ]
        );

    }
}
