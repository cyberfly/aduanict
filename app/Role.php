<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function scopeName($query, $filter)
    {
        return $query->whereName($filter);
    }
}
