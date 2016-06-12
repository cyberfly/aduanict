<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplainAttachment extends Model
{
    protected $table = 'complain_attachments';
    protected $primaryKey = 'attachment_id';

    /**
     * Get all of the owning attachable models.
     */

    public function attachable()
    {
        return $this->morphTo();
    }
}
