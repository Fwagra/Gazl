<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalDocumentation extends Model
{
  protected $fillable = ['md_value', 'html_value', 'project_id'];
  /**
   * An internal documentation belongs to a project
   */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
