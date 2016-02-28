<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BugComment extends Model
{
    /**
	 * A comment  belongs to a bug
	 */
    public function bug()
    {
        return $this->belongsTo('App\Bug');
    }
}
