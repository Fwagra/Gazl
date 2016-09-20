<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
     protected $table = 'contacts';
     protected $fillable = ['name', 'email', 'phone', 'notes'];

    /**
     * A contact can "belong to" one project... or many
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project')->withPivot('is_starred');
    }

    /**
     * A contact can be "starred" for a project
     */
    public function is_starred($project_id)
    {
        return $this->projects()->findOrFail($project_id, ['project_id'])->pivot->is_starred;
    }
}
