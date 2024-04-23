<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $fechaActual = Carbon::now();

        $fechaInscripcion = Carbon::parse($user->inicio);
        $fechaFinalizacion = Carbon::parse($user->final);

        // dd($fechaActual, $fechaInscripcion, $fechaFinalizacion);

        if ($fechaActual->gte($fechaInscripcion) && $fechaActual->lte($fechaFinalizacion)) {
            return $next($request);
        }else{
            $request->session()->forget('inicio');
            $request->session()->forget('final');        
    
            Auth::guard('web')->logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('/');
        }
            
    }
}
