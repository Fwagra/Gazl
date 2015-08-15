<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
	protected $fillable = ['name', 'login', 'password', 'host', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
