<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistPoint extends Model
{
	protected $fillable = ['name', 'description', 'checklist_category_id'];
    /**
	 * A checklist point belongs to a checklist category
	 */
    public function category()
    {
        return $this->belongsTo('App\ChecklistCategory');
    }
}
