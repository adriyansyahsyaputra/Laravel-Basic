<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContohMiddleware
{
    public function handle(Request $request, $next, $key, $status)
    {
        $apikey = $request->header('X-API-KEY');
        if($apikey == $key) {
            return $next($request); 
        }else {
            return response("Access Denied", $status);
        }
    }
}
