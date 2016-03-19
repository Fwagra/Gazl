<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable =  [
		'project_id',
		'user_id',
	]; 

	/**
	 * A project notification subcription  belongs to a project
	 */
    public function project()
    {
        return $this->belongsTo('App\project');
    }

	/**
	 * A project notification subcription  belongs to a user
	 */
    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
