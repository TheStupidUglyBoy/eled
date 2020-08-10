<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body','post_id'];

    public function post(){
    	return $this->belongsTo('App\Post');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function commentReply(){
    	return $this->HasMany('App\CommentReply');
    }

    public function getIsActiveAttribute($value)
    {
        return $value == 1 ? "Approved"  :  "Draft" ;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function isActive($comment)
    {
        return $comment->getAttributes()['is_active']  == 1  ? true  :  false ;
    }
}
