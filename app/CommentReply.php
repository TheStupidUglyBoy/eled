<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = ['body'];

    public function comment(){
    	return $this->belongsTo('App\Comment');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
    

}
