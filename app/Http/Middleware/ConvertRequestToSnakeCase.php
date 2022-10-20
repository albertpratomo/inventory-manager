<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertRequestToSnakeCase
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $request->replace(
            array_keys_convert_case($request->all(), 'snake'),
        );

        return $next($request);
    }
}
