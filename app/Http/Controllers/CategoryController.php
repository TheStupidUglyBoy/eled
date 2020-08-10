<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryValidation;
use App\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('checkAdmin');
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }


    public function create()
    {   
        return view('admin.category.create');
    }

    public function store(CategoryValidation $request)
    {
        $name = $request->validated();
        Category::create($name);
        Session::flash('created_category','success create category with name ' . $name['name']);
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    public function update(CategoryValidation $request, Category $category)
    {
        $request = $request->validated();
        $category->update($request);
        Session::flash('updated_category','success update category with name ' . $request['name']);
        return back();

    }

    public function destroy(Category $category)
    {
        $category->delete($category);
        Session::flash('destroy_category','success delete category with name ' . $category->name);
        return back();
    }
}
