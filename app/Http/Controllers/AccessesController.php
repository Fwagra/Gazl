<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Access;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use \Session;
use \Redirect;
use File;
use Input;
use Cookie;
use Crypt;
use Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccessRequest;
use Illuminate\Contracts\Encryption\DecryptException;

class AccessesController extends Controller
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
     * @param string $projectSlug
     * @return Response
     */
    public function index($projectSlug)
    {
       $project = Project::slug($projectSlug);
       $list = $project->accesses;
       // dd($list);
       echo "list";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($project)
    {
        $access = new Access;
        if(Cookie::get('key') == null):
            Session::flash('error', trans('access.no_key_flash'));
            return redirect(route('key.set'));
        elseif(!Hash::check(Cookie::get('key'), File::get(base_path('storage/.encryption_key')))):
            Session::flash('error', trans('access.wrong_key_flash'));
            return redirect(route('key.set'));
        else:
            return View::make('accesses.new', compact('project', 'access'));
        endif;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $projectSlug
     * @param  StoreAccessRequest  $request
     * @return Response
     */
    public function store($projectSlug, StoreAccessRequest $request)
    {
        $project = Project::slug($projectSlug);
        $request['project_id'] = $project->id;
        Access::create($request->only('name', 'host', 'login', 'password', 'project_id'));
        Session::flash('message', trans('access.success'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $accessId
     * @return Response
     */
    public function show($projectSlug, $accessId)
    {
        $access = Access::find($accessId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($projectSlug, $accessId)
    {
        $project = Project::slug($projectSlug);
        $access = Access::find($accessId);
        if($project->id != $access->project_id){
            return Redirect::action('AccessesController@index', $projectSlug)->withErrors(['message' => trans('access.access_not_found')]);
        }

        return View::make('accesses.edit', compact('project','access'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreAccessRequest  $request
     * @param  string  $projectSlug
     * @param  int  $accessId
     * @return Response
     */
    public function update(StoreAccessRequest $request, $projectSlug, $accessId)
    {
        $project = Project::slug($projectSlug);
        $access = Access::find($accessId);
        $access->update($request->all());
        return redirect(route('project.show', $project->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $projectSlug
     * @param  int  $accessId
     * @return Response
     */
    public function destroy($projectSlug, $accessId)
    {
        $project = Project::slug($projectSlug);
        $access = Access::find($accessId);
        $access->delete();
        return redirect(route('project.show', $project->slug));
    }
    /**
     * Show the form for setting/editing the global encryption key
     * @return Response
     */
    public function setGlobalKey()
    {
        return View::make('encryption_key.admin.form');
    }

    /**
     * Save the new global key
     * @param Request $request
     * @return Response
     */
    public function saveGlobalKey(Request $request)
    {
        $path = base_path('storage/.encryption_key');
        if(File::exists($path)){
            $this->validate($request, [
                'old_key' => 'required|min:32|max:32',
                'key' => 'required|min:32|max:32',
            ]); 
        }else{
            $this->validate($request, [
                'key' => 'required|min:32|max:32',
            ]);
        }
        
        if(File::exists($path)){
            $currentKey = File::get($path);
            if(Hash::check(Input::get('old_key'), $currentKey)){
                $oldKey = Input::get('old_key');
                $newKey = Input::get('key');
                // Function to recrypt accesses
                File::put($path, Hash::make($newKey));

            }else{
                Session::flash('error', trans('access.keys_not_matching'));
            }
        }
        else{
            $newKey = Input::get('key');
            File::put($path, Hash::make($newKey));
        }
        return back();
    }
    /**
     * Show the form for editing the encryption key
     * @return Response
     */
    public function setKey()
    {
        return View::make('encryption_key.form');
    }

    /**
     * Save the encryption key
     * @param Request $request
     * @return Response
     */
    public function saveKey(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|min:32|max:32',
        ]);

        if(Hash::check(Input::get('key'), File::get(base_path('storage/.encryption_key')))){
            Cookie::queue('key', Input::get('key'), 525948);
            Session::flash('message', trans('access.key_saved'));
        }else{
            Session::flash('error', trans('access.key_not_matching'));
        }
        return back();
    }
}
