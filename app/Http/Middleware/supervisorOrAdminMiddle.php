<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class supervisorOrAdminMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( preg_match('/admin/', implode(session('rol'))) || preg_match('/supervisor/', implode(session('rol')))==true) {
            return $next($request);
        }else{
            return redirect('/home');
        }
    }
}
