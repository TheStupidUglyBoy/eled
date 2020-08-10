<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tip;
use App\Category;
use App\User;
use App\News;
use App\Gallery;
use App\Video;
use App\HomePage;

use Cviebrock\EloquentTaggable\Models\Tag ;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

class HomeController extends Controller
{
    //


    public function index(){
        $HomePage = HomePage::first();
        $galleries = Gallery::with('image')->latest()->take(4)->get();
    	$page_title = 'ELED community';
        return view('home.index',compact('page_title','galleries','HomePage'));
    }

    public function posts(){

    	$page_title = 'ELED Posts';
        $posts = Post::active()->with(['user','category'])->latest()->paginate(4);
        return view('home.posts.index',compact('page_title','posts'));
    }

    public function post(Post $post){
        if( !$post->isActive($post) ){ abort(404); }
        views($post)->cooldown(now()->addHours(24))->record();
        $page_title = "$post->slug";
        $comments   = $post->comment()->active()->latest()->get();
        return view('home.post.index',compact('page_title','post','comments'));
    }

    public function category(Category $category){
        $category_name = $category->name ;
        $page_title = "Posts under  $category_name category";
        $posts  = $category->post()->active()->latest()->paginate(8);
        return view('home.category.index',compact('page_title','posts','category_name'));
    }

    public function tag(Tag $tag){

        $posts = Tag::findByName($tag)->posts;
        $posts = $posts->intersect(Post::active()->get())->sortByDesc('id');
        $page_title = "Posts with tag $tag";
        return view('home.tag.index',compact('page_title','posts','tag'));
    }

    public function user_post(User $user){
        if( ! $user->isActive($user)){
            abort(404);
        }
        $page_title = "Posts under author username";
        $posts  = $user->post()->active()->latest()->paginate(4);
        return view('home.user.post',compact('page_title','posts','user'));
    }

    public function tips(){

        $tips = Tip::latest()->paginate(10);
        $page_title = "Tips & Tutorials";
        return view('home.tips.index',compact('page_title','tips'));
    }

    public function news(){

        $news = News::latest()->paginate(10);
        $page_title = "News";
        return view('home.news.index',compact('page_title','news'));
    }

    public function news_show(News $news){

        $page_title = "News";
        return view('home.news.show',compact('page_title','news'));
    }

    public function search(){
        $keyword = htmlspecialchars(request('keyword'));

        $searchResults = (new Search())
               ->registerModel(Post::class, function(ModelSearchAspect $modelSearchAspect){
                $modelSearchAspect
                    ->addSearchableAttribute('title')
                    ->addSearchableAttribute('description')
                    ->active();
               })
               ->search($keyword);
        $page_title = "$keyword";
        return view('home.search.index',compact('page_title','keyword','searchResults'));       
    }

    public function ajax_search(){
        $keyword = htmlspecialchars(request('keyword'));
        $searchResults = (new Search())
               ->registerModel(Post::class, function(ModelSearchAspect $modelSearchAspect){
                $modelSearchAspect
                    ->addSearchableAttribute('title')
                    ->active()
                    ->limit(5)
                    ->orderBy('id', 'desc')->get();
               })->search($keyword);
        if( $searchResults->count() >= 1 ){
            foreach ($searchResults as $key => $value) {
                echo "<li ><a class='text-break' href='$value->url'> $value->title</a> </li>";
            }
            echo "<li class='text-warning'>Only 5 suggestions are fetched , please press ENTER to get full result </li>";
        }else{
            echo "<li class='text-danger' > No Result Found </li>";
        }
    }

    public function gallery(){

        $galleries = Gallery::with('image')->latest()->paginate(12);
        $page_title = "Gallery";
        return view('home.gallery.index',compact('page_title','galleries'));
    }

    public function video(){

        $videos = Video::with('image')->latest()->paginate();
        $page_title = "Videos";
        return view('home.video.index',compact('page_title','videos'));
    }



}
