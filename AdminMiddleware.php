<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use DB;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
        /** @var App\Models\User */

            $user = Auth:: user();
            $roles = DB::table('roles')->pluck('name')->toArray();
            
            if ($user->hasRole([$roles]))
            {
            return $next($request);
            }

           
            return redirect()->route('login')->with('alertMessage', 'Unauthorized action.');

    }
   
    return redirect()->route('login')->with('alertMessage', 'Unauthorized action.');
    }
}
