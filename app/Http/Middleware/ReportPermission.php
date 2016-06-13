<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Entrust;

class ReportPermission
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

        if ($route_name=='report.monthly_statistic_aduan_ict')
        {
            $this->check_entrust_permission('statistic_report_chart',$request);
        }

        if ($route_name=='report.monthly_statistic_table_aduanict')
        {
            $this->check_entrust_permission('statistic_report_table',$request);
        }

        return $next($request);
    }

    function check_entrust_permission($permission_name,$request)
    {
        if(!Entrust::can($permission_name))
        {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                abort(403, 'Access denied');
            }
        }
    }
}
