<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mockup extends Model
{
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
