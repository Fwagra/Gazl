<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

class DocumentationController extends Controller
{

    /**
     * Construct method
     */
    public function __construct() {
      $this->middleware('guest.auth', ['only' => ['index']]);
      $this->middleware('auth', ['except' => ['index']]);
    }
    
    /**
     * Display the documentation if it exists.
     *
     * @param string $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function index($projectSlug)
    {
        $project = Project::slug($projectSlug);
        $doc = $project->documentation;

        return View::make('documentation.index', compact('project', 'doc'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function edit($projectSlug)
    {
        $project = Project::slug($projectSlug);
        $doc = $project->documentation;

        return View::make('documentation.form', compact('project', 'doc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectSlug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectSlug)
    {
        //
    }
}
