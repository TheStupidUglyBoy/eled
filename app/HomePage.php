<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $guarded = [];

    public function getHeadingBackgroundImageAttribute($value)
    {	

    		return asset("img/".$value) ;
    	
    }

    public function getAboutBackgroundImageAttribute($value)
    {	

    		return asset("img/".$value) ;
    	
    }

}
