<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Client
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $userRole= Auth::user()->role;
        if($userRole==1){

            return redirect()->route('admin.dashboard');
        }
        else if($userRole==2){
            return $next($request);

        }
        else if($userRole==3){
            return redirect()->route('dashboard');

        }
        else if($userRole==4){
            return redirect()->route('vendor.dashboard');

        }

    }
}
