<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockupCategory extends Model
{
    protected $fillable = ['name'];

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
        static::deleting(function($category)
        {
            // When using $category->mockups->delete(), the static::deleting is not triggered in Mockup.php
            foreach ($category->mockups as $mockup) {
                $mockup->delete();
            }
        });
    }

}
