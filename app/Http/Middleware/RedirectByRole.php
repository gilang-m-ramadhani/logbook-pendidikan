<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('filament.admin.pages.dashboard');
        } elseif (auth()->user()->hasRole('dosen')) {
            return redirect()->route('dosen.dashboard');
        } elseif (auth()->user()->hasRole('mahasiswa')) {
            return redirect()->route('mahasiswa.dashboard');
        }
    }
        return $next($request);
    }
}
