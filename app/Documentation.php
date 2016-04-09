<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
  /**
   * A documentation  belongs to a project
   */
    public function project()
    {
        return $this->belongsTo('App\project');
    }
}
