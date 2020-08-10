<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\News;
use App\Gallery;
use App\Tip;
use App\Comment;
use App\Company;

class AdminDashboardController extends Controller
{
    

    public function index()
    {
    	$gallery_count = Gallery::count();
    	$tip_count  = Tip::count();
    	$news_count = News::count();
    	$active_comment_count = Comment::active()->count();
    	$active_company_count = Company::active()->count();
        $page_title = 'Welcome To Dashboard';
        return view('admin.dashboard.index',compact('page_title','active_comment_count','news_count','gallery_count','tip_count','active_company_count'));
    }


}
