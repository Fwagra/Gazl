<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Documentation;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Session;
use View;
use Markdown;

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
     * Update / Create the specified resource in storage.
     * Convert the markdown into html and store it for usage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectSlug)
    {
        $project = Project::slug($projectSlug);
        $doc = $project->documentation;

        $mdText = $request->get('md_value');
        $htmlText = Markdown::string($mdText);

        $request->merge([
          'project_id' => $project->id,
          'html_value' => $htmlText,
        ]);
        $fields = $request->all();

        if($doc == null)
        {
          $doc = Documentation::create($fields);
        }
        else
        {
          $doc->update($fields);
        }

        Session::flash('message', trans('doc.success_edit'));
        return redirect()->action('DocumentationController@edit', ['projectSlug' => $projectSlug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectSlug)
    {
      $project = Project::slug($projectSlug);
      $doc = $project->documentation;

      if($doc != null)
        $doc->delete();

      Session::flash('message', trans('doc.deleted_doc'));
      return Redirect::action('ProjectController@show', $projectSlug);
    }
}
