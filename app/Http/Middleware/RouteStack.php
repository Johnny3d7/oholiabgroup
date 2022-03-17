<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class RouteStack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $home = 'module.index';
        $to_ignore = [];

        if($request->method() == "GET" && !in_array(Route::currentRouteName(), $to_ignore)){
            $array = session('routeStack');
            if(Route::currentRouteName() == $home){
                session(['routeStack' => []]);
            } else {
                try {
                    if(count($array) == 0 || $array[array_unshift($array)-1]["name"] != Route::currentRouteName()){
                        array_push($array, [
                            'name' => Route::currentRouteName(),
                            'params' => Route::getCurrentRoute()->parameters()
                        ]);
                        session(['routeStack' => $array]);
                    }
                } catch (\Throwable $th) {
                    return redirect()->route($home);
                }
            }
        }


        // $home = 'module.index';
        // $array = session('routeStack');
        // if(Route::currentRouteName() == $home){
        //     session(['routeStack' => []]);
        // } else {
        //     try {
        //         if(count($array) == 0 || $array[array_unshift($array)-1]["name"] != Route::currentRouteName()){
        //             array_push($array, [
        //                 'name' => Route::currentRouteName(),
        //                 'params' => Route::getCurrentRoute()->parameters()
        //             ]);
        //             session(['routeStack' => $array]);
        //         }
        //     } catch (\Throwable $th) {
        //         return redirect()->route($home);
        //     }
        // }
        return $next($request);
    }
}
