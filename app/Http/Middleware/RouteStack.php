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
        $to_ignore = [
            'df'
        ];

        if($request->method() == "GET" && !in_array(Route::currentRouteName(), $to_ignore)){
            $array = $tab = session('routeStack');
            if(Route::currentRouteName() == $home){
                session(['routeStack' => []]);
            } else {
                try {
                    if(count($array) == 0 || $array[count($array)-1]["name"] != Route::currentRouteName()){
                        array_push($tab, [
                            'name' => Route::currentRouteName(),
                            'params' => Route::getCurrentRoute()->parameters()
                        ]);
                        // dd($array, session('routeStack'));
                    }
                    session(['routeStack' => $tab]);
                } catch (\Throwable $th) {
                    return redirect()->route($home);
                }
            }
        } else { var_dump('Not valid'); }

        // var_dump(session('routeStack'));

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
