<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegisterEvent;
use App\Events\ResetUserPasswordEvent;
use App\Http\Requests\UserRegistration;
use App\Http\Requests\UserUpdateProfileValidation;
use App\Http\Requests\UserUpdatePasswordValidation;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon ;


class UserController extends Controller
{
    
    public $is_active = 'is_active';

    public function index(){

        $user = Auth::user();
        $notifications = $user->notifications()
        ->orderBy('read_at', 'asc')
        ->orderBy('created_at', 'desc')->whereDate('created_at', '>=' , Carbon::now()->subDays(7))->paginate(3);

        $page_title = $user->username ." Profile";
        $comments = $user->comment()->latest()->get();
        return view('home.user.profile',compact('page_title','user','comments','notifications'));
    }

    public function create_register(){
        $page_title = 'User Register';
        return Auth::check() == false ? view('home.user.register',compact('page_title')) : redirect()->route('home') ;
    }

    public function store_register(UserRegistration $request){
        $request    = $request->validated();
        $request = Arr::except($request, ['captcha']);
        $user = User::create($request  +  ['user_type' => "external", 'signup_ip'=>request()->ip()] );
        event(New UserRegisterEvent($user));
        Session::flash('user_register','We had sent you a verification email , please complete verification within 10 minutes, thank you.:');
        return back() ;

    }

    public function verify(User $user,Request $request){
    	//verify user registration   
    	if (! $request->hasValidSignature()) {
	        abort(404);
	    }
	    $user->forceFill(['email_verified_at' => now() , $this->is_active => 1 ])->save();
         Session::flash('verification_is_completed','Hey, '.$user->username.' we had verified your email please login now thanks!');
    	return redirect()->route('login');
    }

    public function login(request $request)
    {
        $page_title = 'User Login';
        return Auth::check() == false ? view('home.user.login',compact('page_title')) : redirect()->route('home') ;
    }

    public function login_process(Request $request)
    {   
        $this->validate($request, ['captcha' => 'required|captcha']);
    	$credentials = $request->only('email', 'password');
        if (   Auth::attempt( $credentials + [ $this->is_active => 1 ]  )  ) {
            return redirect()->route('home.posts'); 
        }
        return redirect()->back()->with('login_fail', 'Fails to Login, Please check your email and password');
    }

    public function update(UserUpdateProfileValidation $request, User $user)
    {
        $this->authorize('update',$user);
        $validatedData = $request->validated();
        $this->upload_avata( $user );
        $user->update(   Arr::except($validatedData, ['image']) );
        Session::flash('updated_user_profile', 'Hey '.$user->username.' you profile is updated');
        return back();
    }

    public function update_user_password(UserUpdatePasswordValidation $request, User $user)
    {
        $this->authorize('update',$user);
        $validatedData = $request->validated();
        $user->update( ['password' => $validatedData['new_password'] ] );
        Auth::logout();
        Session::flash('updated_user_password', 'Hey '.$user->username.' you password is updated, please login now');
        return redirect()->route('login');
    }


    public function resend_veirification_email(){
        $user = User::inactive()->where('email', request()->email )->firstOrFail();
        event(New UserRegisterEvent($user));
        return back()->with('reset_verification','Please check your inbox for verificaiotn email.');
    }


    public function forget_password(){
        $page_title = 'forget password page';
        return view('home.user.forgetpassword',compact('page_title'));
    }

    public function reset_password(){
        $user = User::active()->where('email', request()->email )->firstOrFail();
        event(New ResetUserPasswordEvent($user));
        return back()->with('reset_password_link','Please check your inbox for reset password URL');
    }

    public function password_verify(){
        $email = urldecode(request()->email);
        $token = request()->token;
        $userEmail = DB::table('password_resets')->where('email', $email)->where('token', $token)->latest()->first();
        if( is_null($userEmail) ){  abort(404);   }
        $page_title = 'reset password page';
        return view('home.user.resetpassword',compact('page_title','email','token'));
    }

    public function reset_user_password(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|max:32',
            'new_confirm_password' => ['same:new_password'],
            'email' => 'required|email|exists:users,email',
            'token' => 'required' 
        ]);
        $user = User::where('email', $request->email)->first();
        $user->update(['password'=> $request->new_password]);
        DB::table('password_resets')->where('email', $request->email)->delete();

        Session::flash('updated_user_password', 'Hey '.$user->username.' you password is updated, please login now');
        return redirect()->route('login');
    }


    public function markAllAsRead(){
        
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('user_profile',"#notification")->with('markAllAsRead', 'All notification are read now');
    }

    public function markAsRead($id){
        
        $unreadnotifications  = Auth::user()->unreadNotifications()->findOrFail($id) ;
        $unreadnotifications->update(['read_at' => now()]);
        return redirect( urldecode( request('url') ) );
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    private function upload_avata( $user ){
        if( request()->has('image') ){
            $image_path = request()->image->store('uploads/users','public');
            $user->image()->create(['name' => $image_path ]);
        }
    }

    // private function generate_url($user_id)
    // {
    //     return URL::temporarySignedRoute(
    //         'verify', now()->addMinutes(10), ['user' => $user_id]
    //     );

    // }
}
