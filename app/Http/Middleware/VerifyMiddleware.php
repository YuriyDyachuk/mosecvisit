<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isVerify()){
            abort(403);
        }

        return $next($request);
    }
}
