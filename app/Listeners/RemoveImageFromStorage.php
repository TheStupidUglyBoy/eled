<?php

namespace App\Listeners;

use App\Events\DeleteImageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class RemoveImageFromStorage
{   

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  DeleteImageEvent  $event
     * @return void
     */
    public function handle(DeleteImageEvent $event)
    {
        
        $image = $event->image;
        if( $image->count() >=1 ){
            $image->each(function ($item, $key) {
                $file      = "public/".$item->getAttributes()['name'];
                $thumbnail = "public/".$item->getAttributes()['thumbnail'];
                Storage::delete([$file,$thumbnail]);
            });
        }

    }
}
