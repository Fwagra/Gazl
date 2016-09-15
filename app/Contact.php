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
        return $this->belongsToMany('App\Project');
    }
}
