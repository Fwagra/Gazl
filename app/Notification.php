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


    /**
     * Query notification by project and user
     */
    public function scopeProjectUser($query, $project_id, $user_id)
    {
        return $query->where('project_id',$project_id)->where('user_id', $user_id);
    }
}
