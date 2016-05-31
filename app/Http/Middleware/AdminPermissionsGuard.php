<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Entrust;

class AdminPermissionsGuard
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
        $route_name = Route::currentRouteName();

        if ($route_name=='admin.permissions.index') {

            $this->GuardIfFailed($request, 'manage_permissions');
        }

        if ($route_name=='admin.permissions.create' || $route_name=='admin.permissions.store') {

            $this->GuardIfFailed($request, 'create_permission');
        }

        if ($route_name=='admin.permissions.edit' || $route_name=='admin.permissions.update') {

            $this->GuardIfFailed($request, 'edit_permission');
        }

        if ($route_name=='admin.permissions.destroy') {

            $this->GuardIfFailed($request, 'delete_permission');
        }

        return $next($request);
    }

    private function GuardIfFailed($request, $permission)
    {
        if (!Entrust::can($permission)) {

            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                abort(403, 'Access denied');
            }
        }
    }
}
