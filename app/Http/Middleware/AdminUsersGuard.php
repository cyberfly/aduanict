<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Entrust;

class AdminUsersGuard
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

        if ($route_name=='admin.users.index') {

            $this->GuardIfFailed($request, 'manage_users');
        }

        if ($route_name=='admin.users.create' || $route_name=='admin.users.store') {

            $this->GuardIfFailed($request, 'create_user');
        }

        if ($route_name=='admin.users.edit' || $route_name=='admin.users.update') {

            $this->GuardIfFailed($request, 'edit_user');
        }

        if ($route_name=='admin.users.destroy') {

            $this->GuardIfFailed($request, 'delete_user');
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
