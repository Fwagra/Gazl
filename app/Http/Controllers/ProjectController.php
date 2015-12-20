<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Response;
use App\Project;
use \Session;
use \Redirect;
use \Input;
use \Auth;
use \DB;
use App\Access;
use App\Cms;
use App\Http\Requests\StoreProjectRequest;

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
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        $project = Project::slug($slug);
        $accesses = $project->accesses;
        
        return View::make('projects.show', compact('project', 'accesses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $project = Project::slug($slug);

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
     * @param  string  $slug
     * @return Response
     */
    public function update(StoreProjectRequest $request, $slug)
    {
        $project = Project::slug($slug);

        $project->name = $request->name;
        $project->cms_id = $request->cms;

        $project->save();

        return redirect(route('project.show', $project->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function destroy($slug)
    {
        $project = Project::slug($slug);

        $project->delete();

        Session::flash('message', trans('project.delete_success'));

        return redirect(route('project.index'));
    }

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
}
