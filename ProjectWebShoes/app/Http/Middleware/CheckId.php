<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckId
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
        
        // if(!iseet($id)){
        //     abort(404);
        // }else{
           return $next($request); 
        // // }
        // if($request->hasValidSignature()){
        //     echo "true";
        // }else{
        //     echo "fash";
        // };
        // dd();
        
    }
}
