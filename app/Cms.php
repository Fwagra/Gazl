<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    protected $fillable = ['name'];
    
    /**
     * Get all projects the CMS is linked to.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
