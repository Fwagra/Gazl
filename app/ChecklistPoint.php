<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistPoint extends Model
{
	protected $fillable = ['name', 'description', 'checklist_category_id', 'order'];
    /**
	 * A checklist point belongs to a checklist category
	 */
    public function category()
    {
        return $this->belongsTo('App\ChecklistCategory');
    }

	/**
	* A checklist point may own many anwsers
	*/
    public function answers()
    {
        return $this->hasMany('App\ChecklistAnswer');
    }

    /**
     * Handle children deletion on resource removal
     */
    public static function boot()
    {
        parent::boot();    
        static::deleted(function($product)
        {
            $product->answers()->delete();
        });
    }
}
