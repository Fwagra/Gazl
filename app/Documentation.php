<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
  protected $fillable = ['md_value', 'html_value', 'project_id'];
  /**
   * A documentation  belongs to a project
   */
    public function project()
    {
        return $this->belongsTo('App\project');
    }
}
