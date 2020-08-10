<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name'];

    public function post(){
    	return $this->hasMany('App\Post');
  
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::of($value)->lower()->ucfirst();
    }
}
