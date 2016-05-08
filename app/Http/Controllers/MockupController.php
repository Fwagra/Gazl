<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Mockup;
use View;

class MockupController extends Controller
{
    /**
     * Define the mockup formats
     */
    protected $formats = [
      'desktop' => 'mockup.desktop_format',
      'tablet' => 'mockup.tablet_format',
      'mobile' => 'mockup.mobile_format',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @param Mockup $mockup
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project, Mockup $mockup)
    {
      $categories = $project->mockupCategories->lists('name','id');
      $formats = $this->formats;
      return View::make('mockups.new', compact('project', 'categories', 'formats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Project $project
     * @param Mockup $mockup
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project, Mockup $mockup)
    {
        dd($request);
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
