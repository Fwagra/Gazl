<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ChecklistCategory;
use App\ChecklistPoint;
use App\Project;
use View;

class ChecklistAnswerController extends Controller
{
    /**
     * Display the checklist form for a project.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectSlug)
    {
        $categories = ChecklistCategory::orderBy('order')->get();
        $project = Project::slug($projectSlug);
        $answers = $project->checklistAnswers();
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
    public function update(Request $request, $id)
    {
        //
    }
}
