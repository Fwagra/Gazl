<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistAnswer extends Model
{
    protected $fillable  = ['project_id', 'checklist_point_id', 'check', 'active', 'comment'];
    /**
	 * A checklist answer belongs to a checklist point
	 */
    public function point()
    {
        return $this->belongsTo('App\ChecklistPoint');
    }

    /**
	 * A checklist answer belongs to a project
	 */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
