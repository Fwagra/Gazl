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

class ProjectController extends Controller
{
    /**
     * Construct function
     */
    public function __construct() {
      $this->middleware('guest.auth', ['except' => ['home', 'index', 'searchProject']]);
      $this->middleware('auth', ['only' => ['create', 'store', 'index', 'edit', 'searchProject']]);
    }

    /**
     * Redirect the user whether it's a logged user, a guest user or a non-logged user
     */
    public function home(Request $request)
    {
        if(Auth::check()){
           return  Redirect::route('project.index');
        }elseif (!Auth::check() && $request->cookie('public_id') != null) {
            $project = Project::publicId($request->cookie('public_id'))->first();
            return Redirect::route('project.show', [$project->slug]);
        }else{
           return View::make('home.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('projects.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $project  = new Project;
        $project->name = $request->name;
        $project->slug = $request->name;
        $project->public_id = $request->name;
        $project->save();
        Session::flash('message', trans('project.success'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();
       return View::make('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->first();
       return View::make('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  string  $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->first();
        // Reset slug with mutator
        $request['slug'] = $request->name;
        $project->update($request->all());
        return redirect(route('project.show', $project->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchProject()
    {
        $term = Input::get('term');  
        $results = array();
        $queries = DB::table('projects')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(10)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name, 'slug' => $query->slug];
        }

        return Response::json($results);
    }
}
