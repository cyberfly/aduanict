<?php

namespace App\Http\Middleware;

use App\Complain;
use Closure;
use Route;
use Entrust;
use Auth;

class ComplainPermission
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
        $route_parameters = $request->route()->parameters();

        if ($route_name=='complain.create' || $route_name=='complain.store')
        {
            $this->check_entrust_permission('create_complain',$request);
        }

        if ($route_name=='complain.edit' || $route_name=='complain.update')
        {
            $this->check_entrust_permission('edit_complain',$request);

            $complain_id = $route_parameters['complain'];
            $complain = Complain::find($complain_id);

            //if new, can be edit by owner of complain or bagi pihak only

            if ($complain->complain_status_id==1)
            {
                if(Auth::user()->id!=$complain->user_id && Auth::user()->id!=$complain->user_emp_id)
                {
                    $this->access_denied($request);
                }
            }
        }

        if ($route_name=='complain.destroy')
        {
            $this->check_entrust_permission('delete_complain',$request);
        }

        //check permission helpdesk action

        if ($route_name=='complain.action' || $route_name=='complain.update_action')
        {
            $this->check_entrust_permission('action_complain',$request);
        }

        //check permission unitmanager assign staff

        if ($route_name=='complain.assign_staff' || $route_name=='complain.update_assign_staff')
        {
            $this->check_entrust_permission('assign_technical_staff',$request);
        }

        //check permission technical staff take action on complain

        if ($route_name=='complain.technical_action' || $route_name=='complain.update_technical_action')
        {
            $this->check_entrust_permission('technical_action_complain',$request);

            $complain_id = $route_parameters['complain'];
            $complain = Complain::find($complain_id);

            //if tindakan, technical action can be take by
            // Assigned Technical Staff only, not by pengadu or bagi pihak

            if(($complain->user_id==Auth::user()->id || $complain->user_emp_id==Auth::user()->id) && $complain->action_emp_id!=Auth::user()->id)
            {
                $this->access_denied($request);
            }
        }

        //check permission pengadu verify

        if ($route_name=='complain.verify')
        {
            $this->check_entrust_permission('verify_complain_action',$request);

            $complain_id = $route_parameters['complain'];
            $complain = Complain::find($complain_id);

            //if Verify Sahkan P to Sahkan H, must be done by owner of complain or bagi pihak only

            if ($complain->complain_status_id==4)
            {
                if(Auth::user()->id!=$complain->user_id && Auth::user()->id!=$complain->user_emp_id)
                {
                    $this->access_denied($request);
                }
            }
        }

        return $next($request);
    }

    function check_entrust_permission($permission_name,$request)
    {
        if(!Entrust::can($permission_name))
        {
            $this->access_denied($request);
        }
    }

    function access_denied($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        } else {
            abort(403, 'Access denied');
        }
    }
}
