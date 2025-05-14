<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
       
        if (Auth::check() && auth()->user()->role == '1') {
            return redirect('/admin/dashboard')->with('error','you can not access login page without logout');           
        } 
        
        
        else {
            // If not authenticated, redirect to login with a message
            return $next($request);
        }
    }

    
}
