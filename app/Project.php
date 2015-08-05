<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    
    /**
     * Set the project slug
     *
     * @param  string  $value
     * @return string
     */
    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }

    public function getRouteKey()
    {
    	$this->slug;
    }
}
