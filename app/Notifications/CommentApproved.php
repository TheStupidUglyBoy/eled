<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Post;

class CommentApproved extends Notification
{
    use Queueable;


    public $comment_id ;
    public $url  ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post,$comment_id)
    {
        $this->comment_id = $comment_id;
        $this->url = urlencode( route('home.post', $post->slug .'#comment-id-'.$comment_id )) ; 
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'msg' => "Your Comment Is Approved On This Post ",
            'url' => $this->url ,
            
        ];
    }
}
