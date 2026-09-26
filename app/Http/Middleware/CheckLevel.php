<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   public function handle(Request $request, Closure $next, $level1 = null, $level2 = null, $level3 = null)
    {
       
        if (!Auth::check()) {
            return redirect('/login');
        }

   
        $userLevel = Auth::user()->level;

       
        if ($userLevel == $level1 || $userLevel == $level2 || $userLevel == $level3) {
            return $next($request); 
        }

        
        if ($userLevel == 'customer') {
            return redirect('/home');
        } else {
            return redirect('/product');
        }
    }
}
