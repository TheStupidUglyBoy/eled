<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use CyrildeWit\EloquentViewable\InteractsWithViews; // for post view counter
use CyrildeWit\EloquentViewable\Contracts\Viewable; // for post view counter
use Cviebrock\EloquentTaggable\Taggable;  // for post tag

class Post extends Model implements Viewable, Searchable
{
    use SoftDeletes;
    use InteractsWithViews;
    use Taggable;

    protected $fillable = ['title','category_id','user_id','slug','description'];
    protected $default_post_thumbnail_image = 'img/post-thumbnail-default.jpg';

    


    public function getIsActiveAttribute($value)
    {
        return $value == 1 ? "Approved"  :  "Draft" ;
    }

    public function getDescriptionAttribute($value)
    {
        return strip_tags(html_entity_decode(Str::limit($value,200 ))) ;
    }

    public function getTitleAttribute($value)
    {
        return Str::limit($value,45 )  ;
    }

    //set post title to slug
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::of($value, '-')->slug('-');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value); 
    }

    public function settDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::ucfirst($value); 
    }

    // setup relationship 
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function image(){
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }

    public function get_post_thumb_nail(Post $post){

        if(  $post->image->isNotEmpty()  ){
            return Post::image()->latest()->first()->name;
        }else{
            return asset($this->default_post_thumbnail_image) ;
        }
        
    }

    public function get_post_active_comment_count(Post $post){
        return $post->comment()->active()->count();
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function isActive($post)
    {
        return $post->getAttributes()['is_active']  == 1  ? true  :  false ;
    }

    public function getSearchResult(): SearchResult
     {
        $url = route('home.post', $this->slug);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
         );
     }

}
