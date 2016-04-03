<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
  /**
   * A memo  belongs to a project
   */
    public function project()
    {
        return $this->belongsTo('App\project');
    }
}
