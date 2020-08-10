<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\CommentReply;
use App\Comment;

class CommentReplyController extends Controller
{
    //


    public function create(Request $request){
        $data = [
            'comment_id' =>$request->comment_id,
            'author' =>$user->name,
            'photo' => '',
            'email' =>$user->email,
            'body' =>$request->body,
        ];
        CommentReply::create($data);
        Session::flash('comment_reply','reply succesfully created now pending for approval');
        return redirect()->back();
    }
}
