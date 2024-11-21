<?php

namespace App\Http\Middleware;

use App\Models\Cinema;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class DefaultCinemaSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('cinema_id')) {
            $cinema = Cinema::first();

            if ($cinema) {
                Session::put('cinema_id', $cinema->id);
            }
        }
        
        return $next($request);
    }
}
