<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistCategory extends Model
{
	 /**
     * A checklist category may own many accesses
     */
    public function points()
    {
        return $this->hasMany('App\ChecklistPoint');
    }

    /**
     * Handle children deletion on resource removal
     */
    public static function boot()
    {
        parent::boot();    
        static::deleted(function($product)
        {
            $product->points()->delete();
        });
    }
}
