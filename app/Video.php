<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Video ;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    protected $guarded = [];

    public function image(){
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function get_video(Video $video){

        if(  $video->image->isNotEmpty()  ){
            return Video::image()->latest()->first()->name;
        }
    }




    public function delete()
    {
        DB::transaction(function() 
        {
            $this->image()->delete();
            parent::delete();
        });
    }
}
