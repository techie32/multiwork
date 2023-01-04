<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        // $allowedOrigins = ['*'];
        // $origin = $_SERVER['*'];

        // if (in_array($origin, $allowedOrigins)) {
        //     return $next($request)
        //         ->header('Access-Control-Allow-Origin', '*')
        //         ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
        //         ->header('Access-Control-Allow-Headers', 'Content-Type');
        // }

        // return $next($request);

        return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Request-With');
                // ->header('Access-Control-Allow-Credentials','true');
    }
    // public function handle($request, Closure $next)
    // {
    //     header("Access-Control-Allow-Origin: *");
    //     //ALLOW OPTIONS METHOD
    //     $headers = [
    //         'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
    //         'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
    //     ];
    //     if ($request->getMethod() == "OPTIONS"){
    //         //The client-side application can set only headers allowed in Access-Control-Allow-Headers
    //         return response()->json('OK',200,$headers);
    //     }
    //     $response = $next($request);
    //     foreach ($headers as $key => $value) {
    //         $response->header($key, $value);
    //     }
    //     return $response;

    // }

        
}
