<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Session;

class CheckEmailActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = User::where('email', $request->email  )->first();
        if (   $user->email_verified_at == 'Not Verified'      ){
            Session::flash('user_not_verified' , "Please click on the email confirmation link thanks" );
            return redirect()->route('login');
        }

        return $next($request);
    }
}
