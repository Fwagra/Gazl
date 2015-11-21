<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistPoint extends Model
{
    /**
	 * A checklist point belongs to a checklist category
	 */
    public function project()
    {
        return $this->belongsTo('App\ChecklistCategory');
    }
}
