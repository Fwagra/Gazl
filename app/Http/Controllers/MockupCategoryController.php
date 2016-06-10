<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\MockupCategory;
use App\Project;
use Session;
use Response;
use View;

class MockupCategoryController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  Project  $project
     * @param  MockupCategory  $mockupCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, MockupCategory $category)
    {
        $mockups = $category->mockups()->orderBy('order')->get();
        return View::make('mockups.list', compact('mockups', 'category', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @param  MockupCategory  $mockupCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, MockupCategory $category)
    {
        return View::make('mockups..category.edit', compact('project', 'category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Project  $project
     * @param  MockupCategory  $mockupCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, MockupCategory $category)
    {
        $category->update($request->all());
        Session::flash('message', trans('mockup.success_edit_cat'));
        return redirect()->action('MockupController@index', ['projectSlug' => $project->slug]);
    }

    /**
     * Remove the category and the attached items
     *
     * @param  Request  $request
     * @param  Project  $project
     * @param  MockupCategory  $category
     * @return Response
     */
    public function destroy(Request $request,Project $project,  MockupCategory $category)
    {
        $category->delete();

        if($request->ajax()){
            return Response::json($category->id);
        }else{
            Session::flash('message', trans('mockup.deleted_category'));
            return back();
        }
    }

    /**
     *  Sort the categories
     * @param  Request  $request
     */
    public function order(Request $request)
    {
        if($request->ajax()){
            $input = Input::get('order');
            $i = 1;
             foreach($input as $value) {
                 $category = MockupCategory::find($value);
                 $category->order = $i;
                 $category->save();
                 $i++;
             }
        }
    }
}
