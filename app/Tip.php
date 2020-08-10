<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tip extends Model
{
    protected $fillable = ['question','answer','user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function setQuestionAttribute($value)
    {
        $this->attributes['question'] = Str::of($value)->lower()->title();
    }

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = Str::of($value)->ucfirst();
    }
}
