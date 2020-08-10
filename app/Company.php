<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::of($value)->lower()->ucfirst();
    }

    public function setAboutAttribute($value)
    {
        $this->attributes['about'] = Str::of($value)->lower()->ucfirst();
    }

    public function image(){
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function isActive($company)
    {
        return $company->getAttributes()['is_active']  == 1  ? true  :  false ;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeAll($query)
    {
        return $query->latest()->get();
    }

    public function getIsActiveAttribute($value)
    {
        return $value == 1 ? "Approved"  :  "Draft" ;
    }

    public function getAboutAttribute($value)
    {
        return strip_tags(html_entity_decode(Str::limit($value,100 ))) ;
    }
}
