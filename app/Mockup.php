<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('App\MockupCategory');
    }

}
