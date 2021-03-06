<?php

namespace App\Http\Middleware;

use DB;
use Closure;
use App\Customer;
use Auth;
class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $custumer = Customer::find($request->id);
        if (Auth::user()->id===$custumer->user_id){
          return $next($request);
        }else{
          return response()->json(['Permission denied'], 401);
        }
    }
}
