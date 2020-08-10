<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Image extends Model
{
    
	protected $fillable = ['name','thumbnail'];

	
    public function imageable()
    {
        return $this->morphTo();
    }

    public function getNameAttribute($value)
    {
        return asset("storage/".$value) ;
    }

    public function getThumbnailAttribute($value)
    {
        return asset("storage/".$value) ;
    }


    
}
