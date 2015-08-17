<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Access;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use \Session;
use \Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccessRequest;

class AccessesController extends Controller
{

    /**
     * Construct function
     */
    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($projectSlug)
    {
       $project = Project::slug($projectSlug);
       $list = $project->accesses;
       // dd($list);
       echo "list";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($project)
    {
        $access = new Access;
        return View::make('accesses.new', compact('project', 'access'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($project, StoreAccessRequest $request)
    {
        $project = Project::slug($project);
        $request['project_id'] = $project->id;
        Access::create($request->only('name', 'host', 'login', 'password', 'project_id'));
        Session::flash('message', trans('access.success'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($projectSlug, $accessId)
    {
        $project = Project::slug($projectSlug);
        $access = Access::find($accessId);
        if($project->id != $access->project_id){
            return Redirect::action('AccessesController@index', $projectSlug)->withErrors(['message' => trans('access.access_not_found')]);
        }

        return View::make('accesses.edit', compact('project','access'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreAccessRequest $request, $projectSlug, $accessId)
    {
        dd($accessId);
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
}
