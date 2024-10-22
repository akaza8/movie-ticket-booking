<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $user = Auth::user()->role;
        if($user===$userType){
            return $next($request);
        }
        switch ($userType) {
            case 'admin':
                if($user=='admin'){
                    return $next($request);
                }
                break;

            case 'user':
                if($user=='user'){
                    return $next($request);
                }
                break;
            default:
                return redirect()->route('login');
        }
        switch($user){
            case 'user':
                return redirect()->route('user.dashboard');
            case 'admin':
                return redirect()->route('movies.index');
            default:
            return  redirect()->route('login');
        }
    }
}
