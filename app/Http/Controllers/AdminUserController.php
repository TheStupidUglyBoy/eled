<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\AddUserValidation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class AdminUserController extends Controller
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
        $page_title = 'Show All Users';
        $users = User::with('role','company')->latest()->get();
        return view('admin.user.index',compact('users','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Create Internal Users';
        return view('admin.user.create',compact('page_title'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserValidation $request)
    {
        $request = $request->validated();

        User::create($request + [
            'email_verified_at' => now() , 
            'user_type' => "internal" , 
            'is_active' => 1,
            'signup_ip' => request()->ip(),
        ]);
        $msg = "success create user with email => <strong>".$request['email']."</strong>" ;
        return redirect()->route('admin_user.index')->withSuccess($msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Update Internal User';    
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('page_title','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:10',
            'email' => 'required|email',
            'role_id' => 'nullable',
            'last_name' => 'min:2|max:32',
            'first_name' => 'min:2|max:32',
            'company_id' => 'nullable',
        ]);
        $user->update($validatedData);
        Session::flash('updated_user','success update users with email ' . $validatedData['email']);
        return back() ;
    }


}
