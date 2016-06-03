<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetsLocation extends Model
{
    public function branch()
    {
        return $this->belongsTo('App\Branch','branch_id','id');
    }
}
