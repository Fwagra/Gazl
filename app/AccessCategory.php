<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessCategory extends Model
{
    protected $fillable = ['name'];
    
    /**
     * Get all projects the CMS is linked to.
     */
    public function accesses()
    {
        return $this->hasMany('App\Access');
    }
}
