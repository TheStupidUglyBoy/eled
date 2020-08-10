<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostValidation;
use App\Http\Requests\PostUpdateValidation ;
use App\Post;
use Illuminate\Support\Facades\Session;
use Auth ;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use App\Events\DeleteImageEvent;

use CyrildeWit\EloquentViewable\View;

class AdminPostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user','image','category')->latest()->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(     PostValidation   $request )
    {
        $this->store_post_action(  $request ) ;
        $msg = "success create post with title => <strong>".$request->title."</strong>" ;
        return redirect()->route('post.index')->withSuccess($msg);
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('view', $post);
        return view('admin.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateValidation $request, Post $post)
    {
        $this->authorize('update', $post);
        $this->update_post_action(  $request , $post);
        Session::flash('updated_post','success update post title  ' . $post->title);
        return back() ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post   = Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();
        Session::flash('softed_delete_post','post had been moved to trash');
        return back();
    }

    //display all trash posts
    public function trash_post()
    {
        $posts = Post::with('user')->onlyTrashed()->latest()->get();
        return view('admin.post.trash',compact('posts'));
    }

    //delete trash Permanently
    public function force_destroy($id)
    {
        $post = Post::withTrashed()->find($id);
        $this->authorize('forceDelete', $post);
        $post->detag();
        views($post)->destroy();
        //remove iamge from server event
        event(New DeleteImageEvent($post->image));
        $post->image()->delete();
        $post->forceDelete();
        Session::flash('force_delete_post','post had been deleted FOREVER');
        return back();
    }

    //restore trash post
    public function restore_trash_post($id)
    {
        $post = Post::withTrashed()->find($id);
        $this->authorize('restore', $post);
        $post->restore();
        Session::flash('restore_delete_post','post had been restore');
        return back();
    }

    public function upload_image( Request $request )
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ]);
        $image      =  request()->file('image');
        $file_name =  Auth::id().'-'.Str::random(40).".".$image->getClientOriginalExtension() ;
        $image_path = $image->storeAs('uploads/post', $file_name ,  'public');
        return asset("storage/".$image_path) ;

    }

    private function upload_thumbnail(  $post )
    {
        if( request()->has('thumb_nail_image') ){
            $image      =  request()->file('thumb_nail_image');
            $file_name  =  'thumb_nail_'.Str::random(30).".".$image->getClientOriginalExtension() ;
            Image::make( $image )->fit(350,230)->save(storage_path("app/public/uploads/post/".$file_name));
            $post->image()->create(['name' => "uploads/post/".$file_name ]);
        }
    }

    private function add_tag(  $post )
    {
        $tag = Str::of(request()->tag)->explode(',');
        $post->retag($tag);
    }

    private function create_or_update_product(  $post  , array $product_details)
    {
        if( is_null($post->product) ){
            if( request()->has('confirm_add_product_to_post') &&  request()->has('confirm_add_product_to_post') == 1){
                $post->product()->create($product_details);
            }
        }else{
            $post->product()->update(  $product_details );
        }
    }

    private function get_product_details_array_from_post(array $validatedData)
    {
        return $product_details = Arr::except($validatedData, [
            'title',
            'description',
            'category_id',
            'tag',
            'thumb_nail_image',
            'confirm_add_product_to_post',
            'captcha'
        ]);
    }

    public function store_post_action(  $request )
    {
        $validatedData = $request->validated();
        $post = auth()->user()->post()->create($validatedData + ['slug' => $validatedData['title']  ] );
        $this->upload_thumbnail(  $post );
        $this->add_tag(  $post );
        $this->create_or_update_product(  $post  , $this->get_product_details_array_from_post($validatedData) ) ;
    }

    public function update_post_action(  $request , $post)
    {
        $validatedData = $request->validated();
        $post->update($validatedData + ['slug' => $validatedData['title']  ] );
        $this->upload_thumbnail(  $post );
        $this->add_tag(  $post );
        $this->create_or_update_product(  $post  , $this->get_product_details_array_from_post($validatedData) ) ;
    }






}
