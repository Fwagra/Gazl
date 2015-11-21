<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistCategory extends Model
{
	 /**
     * A checklist category may own many accesses
     */
    public function accesses()
    {
        return $this->hasMany('App\ChecklistPoint');
    }
}
