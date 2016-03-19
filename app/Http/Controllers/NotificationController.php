<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Notification;
use Auth;
use Response;

class NotificationController extends Controller
{
    /**
     * Construct function
     */
    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Create or delete a notification subscription for the provided project to the current user.
     * @param string $project_slug
     */
    public function switchNotification($project_slug)
    {
    	$project = Project::slug($project_slug);
    	$user = Auth::user();
    	$subscription = Notification::projectUser($project->id, $user->id)->first();
    	if(count($subscription)){
    		$subscription->delete();
    	}else{
	    	$notification = new Notification;
	    	$notification->user_id = $user->id;
	    	$notification->project_id = $project->id;
	    	$notification->save();
    	}
    }
}
