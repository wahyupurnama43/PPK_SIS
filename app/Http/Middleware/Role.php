<?php

namespace App\Http\Middleware;

use App\Models\Jabatan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');
        $jabatan = Jabatan::where('id', Auth::user()->id_jabatan)->first();
        if ($jabatan->nama === $role[0]) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
