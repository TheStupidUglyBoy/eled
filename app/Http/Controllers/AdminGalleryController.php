<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Gallery;

use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Events\DeleteImageEvent;

class AdminGalleryController extends Controller
{
    public function __construct(){
        $this->middleware('checkAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ]);
        $image          =  $request->file('file');
        $file_name      =  Str::random(40).".".$image->getClientOriginalExtension() ;
        $thumbnail_name =  'thumb_nail_'.$file_name ;


        $image_path = $image->storeAs('uploads/gallery', $file_name ,  'public');
        Image::make( $image )->fit(400,300)->save(storage_path("app/public/uploads/gallery/".$thumbnail_name));

        $gallery = Gallery::create([]);
        $gallery->image()->create(['name' => $image_path , 'thumbnail' => "uploads/gallery/".$thumbnail_name ]);

    }

    public function edit( Gallery $gallery  )
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update( Gallery $gallery  )
    {
        $gallery->update([ 'description' => request()->description ] );
        return redirect()->route('gallery.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $image = $gallery->image ;
        //remove image from storage event
        event(New DeleteImageEvent($image));
        $gallery->delete($gallery);
        Session::flash('destroy_image','success delete this image') ;
        return back();

    }
}
