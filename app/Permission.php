<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function scopeName($query, $filter)
    {
        return $query->whereName($filter);
    }
}
