<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
	protected $fillable = ['name', 'login', 'password', 'host', 'project_id'];

	/**
	 * An access belongs to a project
	 */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * Encrypt a password with the global key stored in a cookie
     * @param string $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
    	# code...
    }
}
