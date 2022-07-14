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
        /* Configuraton variables declaration */
        $home = 'module.index';
        $max_lenght = 20; // -1 for unlimited

        /* User profile home */
        $user = \Auth::user();
        $user_role = $user->roles->first();
        if($user_role) $home = $user_role->home()['name'];
        /* End User profile home */

        /* Only GET method and not ignored routes are supported */
        $to_ignore = [];
        
        if($request->method() == "GET" && !in_array(Route::currentRouteName(), $to_ignore)){
            $array = session('routeStack', []);

            if($max_lenght <> -1 && count($array) >= $max_lenght) array_shift($array);

            try {
                if(count($array) == 0 || $array[count($array)-1]["name"] != Route::currentRouteName()){
                    array_push($array, [
                        'name' => Route::currentRouteName(),
                        'params' => Route::getCurrentRoute()->parameters()
                    ]);
                }
            } catch (\Throwable $th) {
                var_dump($th);
                return redirect()->route($home);
            }

            session(['routeStack' => $array]);
        }
        return $next($request);
    }
}
