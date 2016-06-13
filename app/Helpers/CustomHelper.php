<?php

namespace App\Helpers;

use Entrust;
use Auth;

class CustomHelper
{
    //show formatted status on table
    public static function format_complain_status($status)
    {
        if($status==1){
            $status = '<span class="label label-primary">Baru</span>';
        }
        else if($status==3)
        {
            $status = '<span class="label label-warning">Sahkan (P)</span>';
        }
        else if($status==2)
        {
            $status = '<span class="label label-warning">Tindakan</span>';
        }
        else if($status==4)
        {
            $status = '<span class="label label-success">Sahkan (H)</span>';
        }
        else if($status==5)
        {
            $status = '<span class="label label-success">Selesai</span>';
        }
        else if($status==7)
        {
            $status = '<span class="label label-warning">Agihan</span>';
        }

        return $status;
    }

    //show kemaksini, tindakan, papar button

    public static function format_action_button($complain)
    {
        $button = '';

        //bila status baru

        if($complain->complain_status_id==1)
        {
            //if helpdesk action complain
            if(Entrust::can('action_complain') && Entrust::hasRole('ict_helpdesk'))
            {
                $url = route('complain.action', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Kemaskini</a>';
            }
            else if(Entrust::can('edit_complain') && ($complain->user_id==Auth::user()->id || $complain->user_emp_id==Auth::user()->id))
            {
                $url = route('complain.edit', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Kemaskini</a>';
            }
            else
            {
                $url = route('complain.show', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>';
            }

            //check delete permission

            if(Entrust::can('delete_complain')){

                $button = $button.' '. '<button type="button" class="btn btn-danger" data-destroy ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button>';
            }

        }
        else if($complain->complain_status_id==2) //bila status tindakan
        {
            if(Entrust::can('technical_action_complain') && $complain->user_id!=Auth::user()->id && $complain->user_emp_id!=Auth::user()->id && $complain->action_emp_id==Auth::user()->id)
            {
                $url = route('complain.technical_action', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Tindakan</a>';

            }
            elseif(Entrust::can('action_complain') && $complain->action_emp_id==Auth::user()->id)
            {
                $url = route('complain.action', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Tindakan</a>';
            }
            else
            {
                $url = route('complain.show', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>';
            }

        }
        else if($complain->complain_status_id==3) //bila status Sahkan P
        {
            if(Entrust::can('verify_complain_action') && $complain->complain_status_id==3 && $complain->user_id==Auth::user()->id)
            {
                $url = route('complain.edit', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Pengesahan</a>';

            }
            else
            {
                $url = route('complain.show', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>';
            }
        }
        elseif($complain->complain_status_id==4) //bila status Sahkan H
        {
            if(Entrust::can('action_complain') && Entrust::hasRole('ict_helpdesk'))
            {
                $url = route('complain.action', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-success"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Pengesahan H</a>';
            }
            else
            {
                $url = route('complain.show', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>';
            }
        }
        elseif($complain->complain_status_id==5)
        {
            $url = route('complain.show', $complain->complain_id);
            $button = '<a href="'.$url.'" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>';

        }
        elseif($complain->complain_status_id==7)
        {
            if(Entrust::can('assign_complain'))
            {
                $url = route('complain.assign_staff', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-warning"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Agihan</a>';
            }
            else
            {
                $url = route('complain.show', $complain->complain_id);
                $button = '<a href="'.$url.'" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>';

            }
        }

        return $button;

    }
}