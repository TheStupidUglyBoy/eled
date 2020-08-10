<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminPostController;

use App\Http\Requests\PostValidation;
use App\Http\Requests\PostUpdateValidation ;
use App\Post;
use Illuminate\Support\Facades\Session;
use Auth ;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use App\Events\DeleteImageEvent;

class PostController extends Controller
{
    
	public function index(){
		
		$posts = Auth::user()->post()->with('category','image')->latest()->paginate(10);
    	$page_title = "All Post";
    	return view('home.post.home-post-index',compact('page_title','posts'));
    }

    public function create(){

    	$page_title = "Create Post To Promote Your Product";
    	return view('home.post.create',compact('page_title'));
    }

    public function store(  PostValidation   $request   ){

		$create_post = new AdminPostController;
		$create_post->store_post_action(  $request ) ;
		return redirect()->route('home.post.all')->with('home_create_post_success','Hey Your Post had been created.');
    }

    public function edit(Post $post){

    	$this->authorize('HomePostUpdate', $post); 
    	$page_title =  $post->getAttributes()['title'] ;
    	return view('home.post.edit',compact('page_title','post'));
    }

    public function update(  PostUpdateValidation   $request  ,Post $post ){

   		$this->authorize('HomePostUpdate', $post); 
		$update_post = new AdminPostController;
		$update_post->update_post_action(  $request , $post);
		return redirect()->route('home.post.all')->with('home_create_post_update','Hey Your Post had been updated.');
    }
}
