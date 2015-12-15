<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChecklistCategory;
use App\ChecklistPoint;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Response;
use View;

class ChecklistPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = ChecklistCategory::orderBy('order')->get();
        $categoriesSelect = ChecklistCategory::lists('name', 'id');
        return View::make('admin.checklist-points.index', compact('categories', 'categoriesSelect'));
    }


    /**
     * Store a newly created point in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            'category' => 'required',
        ]);
        // Getting last category to increment order of the new one
        $highest = ChecklistPoint::orderBy('order', 'desc')->first();
        $highest = (is_object($highest))? $highest->order : 0;
        $point = new ChecklistPoint;
        $point->name = $request->name;
        $point->order = intval($highest) +1;
        $point->description = $request->description;
        $point->checklist_category_id = $request->category;
        $point->save();
        if($request->ajax()){
            return $this->returnList();
        }else{
            Session::flash('message', trans('checklist.added_point'));
            return back();
        }
    }

    /**
     * Return a rendered list of resources for ajax requests.
     *
     * @return Response
     */
    public function returnList()
    {
        $categories = ChecklistCategory::get();
        $data = [
            'view' => View::make('admin.checklist-points.list', compact('categories'))
            ->render(),
            'selector' => '.list-points'
        ];
        return Response::json($data);
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

    /**
     *  Sort the points
     * @param  Request  $request
     */
    public function order(Request $request)
    {
        if($request->ajax()){
            $input = Input::get('order');
            $category = Input::get('category');
            $i = 1;
             foreach($input as $value) {
                 $point = ChecklistPoint::find($value);
                 $point->order = $i;
                 $point->checklist_category_id = $category;
                 $point->save();
                 $i++;
             }
        }
    }
}
