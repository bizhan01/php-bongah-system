<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\RoleManageController;
use Illuminate\Support\Facades\Session;
use App\RoleManage as RoleManageModel;

class RoleManage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $config_role_manages = config('role_manage');
        if ( \Auth::check() ==false ){
            return $next($request);
        }
        $User_id = \Auth::user()->role_manage_id;
        $RoleManage = RoleManageModel::find($User_id);
        $RoleContents = (array)json_decode($RoleManage->content);

        foreach ($config_role_manages as $key => $config_role_manage) {
            if (array_key_exists($key, $RoleContents)) {

                config([
                    'role_manage.' . $key . '.All' => $RoleContents[$key][1],
                    'role_manage.' . $key . '.Show' => $RoleContents[$key][2],
                    'role_manage.' . $key . '.Create' => $RoleContents[$key][3],
                    'role_manage.' . $key . '.Edit' => $RoleContents[$key][4],
                    'role_manage.' . $key . '.Delete' => $RoleContents[$key][5],
                    'role_manage.' . $key . '.Pdf' => $RoleContents[$key][6],
                    'role_manage.' . $key . '.TrashShow' => $RoleContents[$key][7],
                    'role_manage.' . $key . '.Restore' => $RoleContents[$key][8],
                    'role_manage.' . $key . '.PermanentlyDelete' => $RoleContents[$key][9],
                ]);
            }
        }

        return $next($request);



    }
}
