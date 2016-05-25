<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $table = 'smict_aduan';
    protected $primaryKey = 'ADUAN_ID';
    public $timestamps = false;


}
