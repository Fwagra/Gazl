<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    public function project()
    {
        return $this->belongsTo('Project');
    }
}
