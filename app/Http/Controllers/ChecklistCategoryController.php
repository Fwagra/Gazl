<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ChecklistCategory;
use \Input;
use View;

class ChecklistCategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = ChecklistCategory::orderBy('order')->get();
        return View::make('admin.checklist-categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     *  Sort the categories
     * @param  Request  $request
     */
    public function order(Request $request)
    {
        if( $request->ajax() ){
            $input = Input::get('order');
            $i = 1;
             foreach($input as $value) {
                 $category = ChecklistCategory::find($value);
                 $category->order = $i;
                 $category->save();
                 $i++;
             }
        }
    }
}
