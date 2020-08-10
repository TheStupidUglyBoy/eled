<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $fillable = ['title','body','user_id','slug'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function image(){
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::of($value, '-')->slug('-');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::of($value)->lower()->title();
    }

    public function getBodyAttribute($value)
    {
        return strip_tags(html_entity_decode(Str::limit($value,50 ))) ;
    }


    public function get_news_image(News $news){

        if(  $news->image->isNotEmpty()   ){
            $image_path = News::image()->latest()->first()->name; 
            return "<img src='$image_path' alt='... class='img-fluid' /><br>";
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
