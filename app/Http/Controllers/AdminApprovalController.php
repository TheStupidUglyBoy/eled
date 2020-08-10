<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use App\Company;
use Illuminate\Support\Facades\Session;
use App\Notifications\CommentApproved ;
use App\Notifications\CommentDrafted ;
use App\Notifications\PostApproved ;
use App\Notifications\PostDrafted ;

class AdminApprovalController extends Controller
{
    

    public function index(Request $request){

        $validatedData = request()->validate([
            'model' => 'required',
            'id' => 'required',
        ]);
    	$model = $request->model ;

    	if( $model === 'post' ){
    		
    		$post = Post::findOrFail($request->id);
            $this->authorize('approvePost', $post);
            if( !$post->isActive($post) ){
                $post->is_active = 1 ;
                $post->user->notify(new PostApproved( $post ) );
            }else{
                $post->is_active = 0 ;
                $post->user->notify(new PostDrafted( $post ) );
            }
			$post->save();
    	}

        if( $model === 'comment' ){
            
            $comment = Comment::findOrFail($request->id);
            if( !$comment->post->isActive($comment->post) ){
                abort(404);
            }
            
            $this->authorize('approveComment', $comment);
            if( !$comment->isActive($comment) ){
                $comment->is_active = 1 ;
                $comment->user->notify(new CommentApproved( $comment->post , $comment->id) );
            }else{
                $comment->is_active = 0 ;
                $comment->user->notify(new CommentDrafted( $comment->post) );
            }
            $comment->save();

        }

        if( $model === 'user' ){
            
            $user = User::findOrFail($request->id);
            $this->authorize('ActivateUser', $user);
            if( !$user->isActive($user) ){
                $user->is_active = 1 ;
            }else{
                $user->is_active = 0 ;
            }
            $user->save();
        }

        if( $model === 'company' ){
            
            $company = Company::findOrFail($request->id);
            $this->authorize('approveCompany', $company);
            if( !$company->isActive($company) ){
                $company->is_active = 1 ;
            }else{
                $company->is_active = 0 ;
            }
            $company->save();
        }

    	Session::flash('approval_or_draft','success Approve or Draft');
    	return back();



    }

}
