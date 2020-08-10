<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PreviewController extends Controller
{
    

    public function post(Post $post){
    	if( $post->isActive($post) ){ abort(404); }
    	$this->authorize('preview',$post);


        $page_title = "Previewing post with $post->title";
        return view('home.preview.index',compact('page_title','post'));
    }
}
