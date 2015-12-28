<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Project;
use \Request;

class ProjectComposer
{


    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        // $this->users = $users;
    }

    /**
     * Bind data to the view. Display project public id if the url matches the "project/*" pattern
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if(Request::segment(1) == 'project' && !empty(Request::segment(2))){
            $project = Project::slug(Request::segment(2));
            $projectPID = $project->public_id;
            $view->with("projectPID", $projectPID );
        }
    }
}