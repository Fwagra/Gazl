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
use PDF;

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
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $doc = $project->documentation;

        if(!Auth::check() && ($doc == null || $doc->active == 0))
        {
          Session::flash('error', trans('doc.no_access'));
          return redirect()->action('ProjectController@show', ['projectSlug' => $project->slug]);
        }

        if($doc != null)
        {
          return View::make('documentation.index', compact('project', 'doc'));
        }
        else
        {
          return redirect()->action('DocumentationController@edit', ['projectSlug' => $project->slug]);
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
        $doc = $project->documentation;
        $active = (isset($doc->active))? $doc->active : 0;
        return View::make('documentation.form', compact('project', 'doc', 'active'));
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
        return redirect()->action('DocumentationController@edit', ['projectSlug' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
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

      return Redirect::action('ProjectController@show', $project->slug);
    }

    /**
     * Publish the documentation
     * @param Project $project
     */
    public function publish(Project $project)
    {
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

    /**
     * Generate a PDF version of the index page.
     *  @param Project $project
     */
    public function generatePdf(Project $project)
    {
      $doc = $project->documentation;

      $pdf = PDF::loadView('documentation.index', compact('project', 'doc'));
      $pdf->setOption('user-style-sheet', base_path('public/css/pdf.css'));

      return $pdf->download('documentation.pdf');
    }
}
