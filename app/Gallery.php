<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gallery ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Gallery extends Model
{
    
	protected $guarded = [];

    public function image(){
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::of($value)->lower()->ucfirst();
    }

    public function get_image(Gallery $gallery){

        if(  $gallery->image->isNotEmpty()  ){
            return Gallery::image()->latest()->first()->thumbnail;
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
