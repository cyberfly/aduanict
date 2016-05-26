<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplainSource extends Model
{
    public function complains()
    {
        return $this->hasMany('App\Complain');
    }
}
