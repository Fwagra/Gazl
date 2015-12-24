<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ChecklistCategory;
use App\ChecklistPoint;
use App\ChecklistAnswer;
use App\Project;
use Response;
use View;

class ChecklistAnswerController extends Controller
{
    /**
     * Construct function
     */
    public function __construct() {
      $this->middleware('guest.auth', ['only' => ['index']]);
      $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display the checklist form for a project.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectSlug)
    {
        $categories = ChecklistCategory::orderBy('order')->get();
        $project = Project::slug($projectSlug);
        $answers = $project->checklistAnswers->keyBy('checklist_point_id');
        return View::make('checklist.index', compact('categories', 'project', 'answers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    public function update(Request $request, $projectSlug, $pointId)
    {
        $project = Project::slug($projectSlug);
        $answer = ChecklistAnswer::firstOrCreate(['project_id' => $project->id, 'checklist_point_id' => $pointId]);
        $answer->update($request->all());
        if($request->check != 1)
            $answer->check = 0;
        if($request->active != 1)
            $answer->active = 0;

        $answer->save();
       return Response::json($answer);
    }
}
