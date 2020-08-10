<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tip;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\TipsValidation;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $page_title = 'Show All Tips';
        $tips = Tip::with('user')->latest()->get();
        return view('admin.tip.index',compact('tips','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Create Tips';
        return view('admin.tip.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipsValidation $request)
    {
        $validatedData = $request->validated();
        auth()->user()->tip()->create($validatedData);

        $msg = "success create tips tutorial with name => <strong>".$validatedData['question']."</strong>" ;
        return redirect()->route('tip.index')->withSuccess($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(tip $tip)
    {
        $page_title = 'Update Tips';
        $this->authorize('view', $tip);
        return view('admin.tip.edit',compact('page_title','tip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipsValidation $request, Tip $tip)
    {
        $this->authorize('update', $tip);
        $validated = $request->validated();
        $tip->update($validated);
        Session::flash('updated_tips','success update TIP question  ' . $validated['question']);
        return back() ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip)
    {
        $this->authorize('delete', $tip);
        $tip->delete($tip);
        Session::flash('destroy_tips','success delete tips with question ' . $tip->question);
        return back();
    }
}
