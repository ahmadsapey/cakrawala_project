<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->role !== 'maintenance') {
            return redirect()->route('maintenance.login');
        }

        return $next($request);
    }
}
