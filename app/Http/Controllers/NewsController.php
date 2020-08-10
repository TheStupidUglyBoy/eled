<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\NewsValidation;
use App\Events\DeleteImageEvent;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('user','image')->latest()->get();
        return view('admin.news.index',compact('news'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsValidation $request)
    {
        $validated = $request->validated();
        $news = auth()->user()->news()->create($validated + ['slug'=>$request['title']]);
        $this->image_upload($news);
        $msg = "success create news with name => <strong>".$request['title']."</strong>" ;
        return redirect()->route('news.index')->withSuccess($msg);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //dd($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {   
        $this->authorize('view', $news);
        $page_title = 'Update News';
        return view('admin.news.edit',compact('page_title','news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsValidation $request, News $news)
    {
        $this->authorize('update', $news);
        $validated = $request->validated();
        $news->update($validated + ['slug' => $validated['title']  ]);
        $this->image_upload($news);
        Session::flash('updated_news','success update News with title ' . $validated['title']);
        return back() ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        //delete all associated images
        event(New DeleteImageEvent($news->image));
        $news->delete($news);
        Session::flash('destroy_news','success delete tip with title ' . $news->title);
        return back();
    }

    private function image_upload($news){
        if( request()->has('image') ){
            $image_path = request()->image->store('uploads/news','public');
            $news->image()->create(['name' => $image_path ]);
        }
    }

}
