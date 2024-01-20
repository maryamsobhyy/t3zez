<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSecretMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle($request, Closure $next)
     {
         $secret = $request->header('apiSecret');

         if (!isset($secret)) {
             return response()->json(['error' => 'Enter apiSecret'], 403);
         }

         if ($secret !== env('API_SECRET', 'MDb#jfr7823$jd')) {
             return response()->json(['error' => 'apiSecret not correct.'], 403);
         }

         return $next($request);
     }
}
