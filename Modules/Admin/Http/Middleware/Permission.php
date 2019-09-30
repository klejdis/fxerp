<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Modules\Admin\Support\Helper;
use Sentinel;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $route = $request->route();
        $routeName = $route->getName();

        //CHECK IF IS LOGGED IN
        if (Sentinel::check()) {
            if (Sentinel::hasAccess($permission)) {
                return $next($request);
            }else{
                if (Helper::checkRouteForPermission( Helper::getPreviusRoute() )){
                    if (!$request->ajax()){
                        return redirect()->back()->with([
                            'error_message' => __('admin::admin.Not Authorized For This Action')
                        ]);
                    }

                    return response()->json([
                        'status' => 'ERROR',
                        'message' => __('admin::admin.Not Authorized For This Action')
                    ],422);

                }else{
                    abort(403);
                }
            }
        }else{
            //IF NOT LOGGED IN REDIRECT TO LOGIN PAGE
            return redirect()->route('admin.auth.login');
        }
    }
}
