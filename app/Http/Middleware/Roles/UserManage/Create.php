<?php

namespace App\Http\Middleware\Roles\UserManage;

use Closure;

use Illuminate\Support\Facades\Session;

class Create
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
        $UserCreate=config('role_manage.User.Create');
        if ($UserCreate){ // Create
            return $next($request);
        }else{
            Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect()->back();
        }
    }
}
