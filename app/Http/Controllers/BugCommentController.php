<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bug;
use App\BugComment;
use App\Events\NewBugComment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use Auth;
use Event;
use \Redirect;
use Session;

class BugCommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project  $project
     * @param  Bug  $bug
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project, Bug $bug)
    {
        if(Auth::check()){

            $this->validate($request, [
                'comment' => 'required|max:1500',
            ]);

            $user = Auth::user();

            $request->merge([
                'name' => $user->first_name . ' ' . $user->name,
                'guest' => 0
            ]);

        }else{

            $this->validate($request, [
                'name' => 'required|max:255',
                'comment' => 'required|max:1500',
            ]);

            $request->merge([
                'guest' => 1
            ]);
        }

        $request->merge([
            'bug_id' => $bug->id
        ]);

        $fields = $request->all();

        $bugComment = BugComment::create($fields);
        Event::fire(new NewBugComment($bugComment));

        Session::flash('message', trans('bug.added_comment'));
        return Redirect::action('BugController@show', [$project->slug, $bug->id]);

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
