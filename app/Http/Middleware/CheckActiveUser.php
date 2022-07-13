<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveUser
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
        if(Auth::user()->flag_active === 'Y'){
            return $next($request);
        }
        else{
            session()->flush();
            session()->flash('msgUserInactive', 'Akun anda telah di Non-Aktifkan! Masa dan session kini telah berakhir, jika ingin minta admin mengaktifkan kembali. Terimakasih!');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
