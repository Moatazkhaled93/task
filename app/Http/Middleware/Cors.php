<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use Closure;

/**
 * Description of Cors
 *
 * @author moata
 */
class Cors {

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
//        $allowedOrigins = [
//            'http://localhost:8080',
//        ];
//        $requestOrigin = $request->headers->get('origin');
//        if (in_array($requestOrigin, $allowedOrigins)) {
//            return $next($request)
//                ->header('Access-Control-Allow-Origin', '*')
//                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
////                ->header('Access-Control-Allow-Credentials', 'true')
//                ->header('Access-Control-Allow-Headers', 'Content-Type,x-csrf-token,x-xsrf-token, Authorization');
////        }
//
//        return $next($request);



        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');

        return $response;
    }

}
