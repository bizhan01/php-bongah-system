<?php

namespace App\Http\Middleware\Roles\Report\FixedAssetsSchedule;

use Closure;
use Illuminate\Support\Facades\Session;

class All
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
        if (config('role_manage.FixedAssetsSchedule.All')){
            return $next($request);
        }else{
            Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect()->route('dashboard');
        }
    }
}
