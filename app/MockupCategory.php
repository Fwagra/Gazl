<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockupCategory extends Model
{
  /**
   * A mockup category  belongs to a project
   */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

  /**
   * A mockup category  has many mockups
   */
    public function mockups()
    {
        return $this->hasMany('App\Mockup');
    }

    /**
     * Handle children deletion on resource removal
     */
    public static function boot()
    {
        parent::boot();
        static::deleted(function($category)
        {
            $category->mockups()->delete();
        });
    }

}
