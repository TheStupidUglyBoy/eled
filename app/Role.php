<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($value)
    {
        return $this->attributes['name']  = Str::lower($value); 
    }

    public function user(){
    	return $this->hasMany("App\User");
    }
}
