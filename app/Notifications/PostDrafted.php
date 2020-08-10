<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Post;
class PostDrafted extends Notification
{
    use Queueable;
    public $url ;
    public $post_title ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->url        = urlencode( route('user_profile', '#notification' )) ; 
        $this->post_title = $post->post_title ; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'msg' => "Your Post Was $this->post_title Draft ",
            'url' => $this->url   ,
        ];
    }
}
