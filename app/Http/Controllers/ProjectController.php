<?php

namespace App\Http\Controllers;

use \Auth;
use \DB;
use \Input;
use \Redirect;
use \Response;
use \Session;
use App\Access;
use App\ChecklistPoint;
use App\Cms;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreProjectRequest;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProjectController extends Controller
{
    /**
     * Construct function
     */
    public function __construct() {
      $this->middleware('guest.auth', ['except' => ['home', 'index', 'searchProject', 'create']]);
      $this->middleware('auth', ['only' => ['create', 'store', 'index', 'edit', 'searchProject']]);
    }

    /**
     * Redirect the user whether it's a logged user, a guest user or a non-logged user
     */
    public function home(Request $request)
    {
        if(Auth::check()){
           return  Redirect::route('project.index');
        }
        elseif (!Auth::check() && $request->cookie('public_id') != null)
        {
            $project = Project::publicId($request->cookie('public_id'))->first();
            return Redirect::route('project.show', [$project->slug]);
        }
        else
            return View::make('home.index');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::all();

        return View::make('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cms = Cms::lists('name', 'id');
        $selected_cms = [];

        return View::make('projects.new', compact('cms', 'selected_cms'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return Response
     */
    public function show(Project $project)
    {
        $answers = $this->getChecklistStatus($project);
        $accesses = $project->accesses;
        $bugs = $this->getBugsCounts($project);
        $memos = $this->getMemos($project);
        $mockups = $this->getMockups($project);
        $doc = $project->documentation;
        return View::make('projects.show', compact(
          'project',
          'accesses',
          'answers',
          'bugs',
          'memos',
          'doc',
          'mockups'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return Response
     */
    public function edit(Project $project)
    {

        $cms = Cms::lists('name', 'id');
        $selected_cms = $project->cms_id;

        return View::make('projects.edit', compact('project', 'cms', 'selected_cms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project  = new Project;

        $project->name = $request->name;
        $project->public_id = $request->name;
        $project->cms_id = $request->cms;

        $project->save();

        Session::flash('message', trans('project.success'));

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Project  $project
     * @return Response
     */
    public function update(StoreProjectRequest $request,Project $project)
    {
        $project->name = $request->name;
        $project->cms_id = $request->cms;

        $project->save();

        return redirect(route('project.show', $project->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        Session::flash('message', trans('project.delete_success'));

        return redirect(route('project.index'));
    }

    /**
     * Search through project names for ajax autocomplete
     */
    public function searchProject()
    {
        $term = Input::get('term');

        if(is_null($term))
            return Response::json('no result');

        $queries = DB::table('projects')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(10)->get();

        $results = array();
        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->name, 'slug' => $query->slug];
        }

        return Response::json($results);
    }

    /**
     * Check the checklist status for the current project
     * @param Project $project
     * @return array $answers
     */
    public function getChecklistStatus($project)
    {
        // Checked and active answers
        $answers['checked'] = $project->checklistAnswers()
                            ->where('check', 1)
                            ->where('active', 1)
                            ->count();

        // Default number of points in a checklist
        $checklistPoints = ChecklistPoint::all()->count();

        // Inactive points
        $inactivePoints = $project->checklistAnswers()->where('active', 0)->count();

        // Total of points that should be counted since the inactive ones are subtracted
        $answers['total'] = $checklistPoints - $inactivePoints;

        return $answers;
    }

    /**
     * Get the number of new bugs and the total number of bugs for the provided project
     * @param Project $project
     * @return array $bugs
     */
    public function getBugsCounts($project)
    {
      if (Auth::check())
      {
        $bugs['new'] = count($project->bugs()->where('state', 1)->get());
        $bugs['total'] = count($project->bugs);
      }
      else
      {
        $bugs['new'] = count($project->bugs()->where('state', 1)->where('private', 0)->get());
        $bugs['total'] = count($project->bugs()->where('private', 0)->get());
      }

      return $bugs;
    }

    /**
     * Return the number of memos and their status
     * @param Project $project
     * @return array $memos
     */
    public function getMemos($project)
    {
      $memos['total'] = count($project->memos);
      $memos['active'] = count($project->memos()->where('active', 1)->get());
      $memos['left'] = $memos['total'] - $memos['active'];

      return $memos;
    }

    /**
     * Return the number of memos and their categories
     * @param Project $project
     * @return array $mockups
     */
    public function getMockups($project)
    {
        $mockups['total'] = count($project->mockups);
        $mockups['categories'] = count($project->mockupCategories);

        return $mockups;
    }
}
