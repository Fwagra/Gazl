<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Mockup extends Model
{

    protected $fillable = [
        'name',
        'color',
        'format',
        'images',
        'psd',
        'project_id',
        'mockup_category_id',
        'order',
        'description',
    ];

  /**
   * A mockup  belongs to a project
   */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

  /**
   * A mockup  belongs to a category
   */
    public function category()
    {
        return $this->belongsTo('App\MockupCategory', 'mockup_category_id');
    }

    /**
    * Handle files deletion on cascading delete
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function($mockup)
        {
            if (isset($mockup->images) && !empty($mockup->images)) {
               $filename = $mockup->images;
               $path = 'uploads/mockups/';
               if (File::exists($path.$filename)) {
                   File::delete($path.$filename);
               }
            }
            if (isset($mockup->psd) && !empty($mockup->psd)) {
               $filename = $mockup->psd;
               $path = 'uploads/psd/';
               if (File::exists($path.$filename)) {
                   File::delete($path.$filename);
               }
            }
        });
    }




}
