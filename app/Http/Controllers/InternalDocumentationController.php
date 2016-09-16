<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\InternalDocumentation;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Session;
use View;
use Markdown;
use Auth;

class InternalDocumentationController extends Controller
{

    /**
     * Construct method
     */
    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Display the documentation if it exists.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $doc = $project->internalDocumentation;

        if($doc != null)
        {
          return View::make('internalDocumentation.index', compact('project', 'doc'));
        }
        else
        {
          return redirect()->action('InternalDocumentationController@edit', ['projectSlug' => $project->slug]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $doc = $project->internalDocumentation;
        return View::make('internalDocumentation.form', compact('project', 'doc'));
    }

    /**
     * Update / Create the specified resource in storage.
     * Convert the markdown into html and store it for usage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $doc = $project->internalDocumentation;

        $mdText = $request->get('md_value');
        $htmlText = Markdown::string($mdText);

        $request->merge([
          'project_id' => $project->id,
          'html_value' => $htmlText,
        ]);
        $fields = $request->all();
        if($doc == null)
        {
          $doc = InternalDocumentation::create($fields);
        }
        else
        {
          $doc->update($fields);
        }

        Session::flash('message', trans('doc.success_edit'));
        return redirect()->action('InternalDocumentationController@edit', ['projectSlug' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
      $doc = $project->internalDocumentation;

      if($doc != null)
      {
        $doc->delete();
        Session::flash('message', trans('doc.deleted_doc'));
      }
      else
      {
        Session::flash('error', trans('doc.no_doc_matching'));
      }

      return Redirect::action('ProjectController@show', $project->slug);
    }
}
