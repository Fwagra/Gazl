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
use Auth;

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

        if(!Auth::check() && ($doc == null || $doc->active == 0))
        {
          Session::flash('error', trans('doc.no_access'));
          return redirect()->action('ProjectController@show', ['projectSlug' => $projectSlug]);
        }

        if($doc != null)
        {
          return View::make('documentation.index', compact('project', 'doc'));
        }
        else
        {
          return redirect()->action('DocumentationController@edit', ['projectSlug' => $projectSlug]);
        }
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
        $active = (isset($doc->active))? $doc->active : 0;
        return View::make('documentation.form', compact('project', 'doc', 'active'));
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
      {
        $doc->delete();
        Session::flash('message', trans('doc.deleted_doc'));
      }
      else
      {
        Session::flash('error', trans('doc.no_doc_matching'));
      }

      return Redirect::action('ProjectController@show', $projectSlug);
    }

    /**
     * Publish the documentation
     * @param string $projectSlug
     */
    public function publish($projectSlug)
    {
      $project = Project::slug($projectSlug);
      $doc = $project->documentation;

      if($doc != null)
      {
        $doc->active = 1;
        $doc->save();
        Session::flash('message', trans('doc.published_doc'));
      }

      else{
        Session::flash('error', trans('doc.no_doc_matching'));
      }

      return redirect()->back();
    }
}
