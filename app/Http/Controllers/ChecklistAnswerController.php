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
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $categories = ChecklistCategory::orderBy('order')->get();
        $answers = $project->checklistAnswers->keyBy('checklist_point_id');
        return View::make('checklist.index', compact('categories', 'project', 'answers'));
    }

    /**
     * Create or update an existing answer in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project  $project
     * @param  int  $pointId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, $pointId)
    {
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
