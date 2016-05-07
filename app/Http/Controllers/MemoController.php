<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Memo;
use Input;
use Response;
use View;

class MemoController extends Controller
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
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $memos = $project->memos()->orderBy('order')->get();
        return View::make('memos.index', compact('project','memos'));
    }

    /**
     * Return a rendered list of resources for ajax requests.
     *
     * @param Project $project
     * @return Response
     */
    public function returnList(Project $project)
    {
        $memos = $project->memos()->orderBy('order')->get();
        $data = [
            'view' => View::make('memos.list', compact('memos', 'project'))
            ->render(),
            'selector' => '.list-group'
        ];
        return Response::json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, Project $project)
     {
         $this->validate($request, [
             'name' => 'required|max:255',
         ]);
         // Getting last category to increment order of the new one
         $highest = Memo::orderBy('order', 'desc')->first();
         $highest = (is_object($highest))? $highest->order : 0;
         $memo = new Memo;
         $memo->name = $request->name;
         $memo->project_id = $project->id;
         $memo->order = intval($highest) +1;
         $memo->save();
         if($request->ajax()){
             return $this->returnList($project);
         }else{
             Session::flash('message', trans('memo.added_memo'));
             return back();
         }
     }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Project $project
     * @param  Memo $memo
     * @return Response
     */
    public function update(Request $request,Project $project, Memo $memo)
    {
        $this->validate($request, [
            'edit-input' => 'required|max:255',
        ]);

        $memo->name = $request->input('edit-input');
        $memo->save();

        if($request->ajax()){
            return Response::json($request->input('edit-input'));
        }else{
            Session::flash('message', trans('memo.updated_memo'));
            return back();
        }
    }

    /**
     * Remove the category and the attached items
     *
     * @param  string  $projectSlug
     * @param  Project $project
     * @param  Memo $memo
     * @return Response
     */
    public function destroy(Request $request, Project $project, Memo $memo)
    {
        $memo->delete();

        if($request->ajax()){
            return Response::json($memo->id);
        }else{
            Session::flash('message', trans('memo.deleted_memo'));
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
                 $memo = Memo::find($value);
                 $memo->order = $i;
                 $memo->save();
                 $i++;
             }
        }
    }

    /**
     * Change the memo session_status
     * @param Request $request
     * @param Memo $memo
     */
    public function check(Request $request, Memo $memo)
    {
      if($request->ajax()){
         $memo->active = ($memo->active == 0)? 1 : 0;
         $memo->save();
      }
    }
}
