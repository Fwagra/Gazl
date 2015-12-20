<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistAnswer extends Model
{
    /**
	 * A checklist answer belongs to a checklist point
	 */
    public function point()
    {
        return $this->belongsTo('App\ChecklistPoint');
    }
}
