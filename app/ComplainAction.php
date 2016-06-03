<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplainAction extends Model
{
    public function complain()
    {
        return $this->belongsTo('App\Complain');
    }

    public function user()
    {
        return $this->belongsTo('App\User','action_by','id');
    }

    public function complain_user()
    {
        return $this->belongsTo('App\User','user_emp_id','id');
    }

    public function complain_status()
    {
        return $this->belongsTo('App\ComplainStatus','complain_status_id','status_id');
    }


}
