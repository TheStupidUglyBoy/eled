<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{


    public function index(){
    	$page_title = 'Show All Comments';
        $comments = Comment::with('user','post')->latest()->get();
        return view('admin.comment.index',compact('comments','page_title'));

    }


	public function store(	Request	$request, Post $post){

		Auth::user()->comment()->create(['body'=>$request->body,'post_id' => $post->id] );
		return redirect()->back()->with('comment_created_msg','comment is now pending for approval');
	}


	public function update(	Request $request , Comment $comment)
	{
		$this->authorize('update', $comment);
		$comment->body   = $request->body;
        if(  $comment->isDirty()  ){
            $comment->save();
            Session::flash('updated_comment', 'Hey '.Auth::user()->username.' you comment is updated');
        }else{
            Session::flash('nothing_to_update', 'Ops, look like you did not update anything!');
        }
        $querystring = $comment->post->slug."#comment-id-$comment->id";
        return redirect()->route('home.post', $querystring);
	}


	public function destroy(Comment $comment)
	{
		$this->authorize('delete', $comment);
		$comment->delete($comment);
		return redirect()->back()->with('comment_delete_msg','comment deleted');
	}


}
