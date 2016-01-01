<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Bug;
use View;
use \Session;

class BugController extends Controller
{
    /**
     * Construct function
     */
    public function __construct() {
      $this->middleware('guest.auth', ['except' => []]);
      $this->middleware('auth', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function index($projectSlug)
    {
        $project = Project::slug($projectSlug);
        return View::make('bugs.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function create($projectSlug)
    {
        $project = Project::slug($projectSlug);
        return View::make('bugs.new', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectSlug)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'images[]' => 'image',
        ]);
        $project = Project::slug($projectSlug);
        // if($request->hasFile('images')){
        //     dd($request->file('images'));
        // }
        $request->merge([
            'project_id' => $project->id,
            'guest' => (Auth::check())? 0 : 1,
            'state' => 1
        ]);

        Bug::create($request->all());

        Session::flash('message', trans('bug.success'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
