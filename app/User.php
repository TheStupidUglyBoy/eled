<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Avatar;


//class User extends Authenticatable

class User extends Authenticatable implements MustVerifyEmail

{
    use Notifiable;

    protected $admin_name = "superadmin";
    protected $editor = "editor";
    protected $author = "author";
    protected $base = "base";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = Str::of($value)->lower();
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = Str::of($value)->lower()->ucfirst();
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = Str::of($value)->lower()->ucfirst();
    }


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getIsActiveAttribute($value)
    {
        return $value === 0 ?  "Not Verified"  :  "Verified" ;
    }

    public function getBioAttribute($value)
    {
        return is_null($value) ? "User is a secretive person"  : Str::ucfirst($value) ;
    }


    public function Role(){
        return $this->belongsTo('App\Role');
    }

    public function News(){
        return $this->hasMany('App\News');
    }

    public function Tip(){
        return $this->hasMany('App\Tip');
    }

    public function post(){
        return $this->hasMany('App\Post');
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }

    public function image(){
        return $this->morphMany('App\Image', 'imageable');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function IsAdmin(){

            return $this->role->name == $this->admin_name ? true : false ;
    }

    public function IsBaseUser(){
        return $this->role_id == null  ?   true : false ;
    }

    public function allowAdminEditor(){
        $role = $this->role->name ;
        if(  $role == $this->editor || $role == $this->admin_name  ){
            return true ;
        }
    }

    public function get_user_avatar (User $user){
        $image = $user->image;
        if( $image->count() >= 1 ){
            return User::image()->latest()->first()->name;
        }else{ 
            return Avatar::create($user->username)->toBase64();
        }
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function isActive($user)
    {
        return $user->getAttributes()['is_active']  == 1  ? true  :  false ;
    }



}
