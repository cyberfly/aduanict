<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Entrust;

class AdminRolesGuard
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

        if ($route_name=='admin.roles.index') {

            $this->GuardIfFailed($request, 'manage_roles');
        }

        if ($route_name=='admin.roles.create' || $route_name=='admin.roles.store') {

            $this->GuardIfFailed($request, 'create_role');
        }

        if ($route_name=='admin.roles.edit' || $route_name=='admin.roles.update') {

            $this->GuardIfFailed($request, 'edit_role');
        }

        if ($route_name=='admin.roles.destroy') {

            $this->GuardIfFailed($request, 'delete_role');
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
