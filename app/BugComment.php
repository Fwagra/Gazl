<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BugComment extends Model
{
	protected $fillable =  [
		'name',
		'comment',
		'guest',
		'bug_id'
	]; 

    protected $guestID;


    /**
	 * A comment  belongs to a bug
	 */
    public function bug()
    {
        return $this->belongsTo('App\Bug');
    }
}
