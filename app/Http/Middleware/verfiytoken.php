<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class verfiytoken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->token;
            if ($token){
                    // $request->headers->set('token', (string)$token, true);
                    // $request->headers->set('Authorization', 'Bearer ' . $token, true);
                    $user = JWTAuth::parseToken()->authenticate();}
                // }else{
                //      return $this->returnError("",'Token is null');
                //  }
            } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(["",'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(["",'Token is Expired']);
            }else{
                return response()->json(["",'Authorization Token not found']);
            }
        }
        return $next($request);
    }
}
