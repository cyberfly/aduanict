<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $table = 'complains';
    protected $primaryKey = 'complain_id';

    /**
     * Get the user that owns the complain.
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function asset()
    {
        return $this->belongsTo('App\Asset','ict_no','id');
    }

    public function assets_location()
    {
        return $this->belongsTo('App\AssetsLocation','lokasi_id','location_id');
    }

    public function complain_level()
    {
        return $this->belongsTo('App\ComplainLevel');
    }

    public function complain_source()
    {
        return $this->belongsTo('App\ComplainSource','complain_source_id','source_id');
    }

    public function complain_category()
    {
        return $this->belongsTo('App\ComplainCategory','complain_category_id','category_id');
    }

    public function complain_status()
    {
        return $this->belongsTo('App\ComplainStatus');
    }

    public function action_user()
    {
        return $this->belongsTo('App\User');
    }

    public function verify_user()
    {
        return $this->belongsTo('App\User');
    }

    public function attachments()
    {
        return $this->morphMany('App\ComplainAttachment', 'attachable');
    }
    
    public function complain_action()
    {
        return $this->hasMany('App\ComplainAction','complain_id','complain_id');
    }

}
