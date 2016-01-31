<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Bug;
use Carbon\Carbon;
use DB;
use Image;
use Input;
use File;
use View;
use Validator;
use \Session;
use Response;

class BugController extends Controller
{
    /**
     * Construct function
     */
    public function __construct() {
      $this->middleware('guest.auth', ['except' => []]);
      $this->middleware('auth', ['only' => ['edit', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function index($projectSlug)
    {
        $project = Project::slug($projectSlug);
        $bugs  = $this->getAllBugs($project);
        return View::make('bugs.index', compact('project', 'bugs'));
    }

    /**
     * Return a bug list filtered and sorted
     * @param object $project
     * @return \Illuminate\Http\Response
     */
    protected function getAllBugs($project)
    {
        // Get only the public bugs if the user is not logged
        if(!Auth::check()){
            $bugs = $project->bugs()->where('private', 0);
        }else{
            $bugs = $project->bugs();
        }

        // Sort the bugs by state if needed
        if(Input::get('order') && Input::get('order') == 'state'){
            $bugs->orderBy('state', 'asc');
        }
        // Sort them by date anyway 
        $bugs->orderBy('created_at', 'desc');

        return $bugs->paginate(50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function create($projectSlug)
    {
        $project = Project::slug($projectSlug);
        return View::make('bugs.new', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $projectSlug
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectSlug)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            // 'images' => 'image',
        ]);
        $project = Project::slug($projectSlug);
        if($request->hasFile('images')){
            $images = $request->file('images');
            $imagesStored = [];
            foreach ($images as $key => $image) {
                $rules = array('file' => 'image|max:500');
                $validator = Validator::make(array('file'=> $image), $rules);
                if($validator->passes()) {
                    $filename = $this->saveImage($projectSlug, $image);
                    $imagesStored[] = $filename;
                } else {
                    // redirect back with errors.
                    return back()->withInput()->withErrors($validator);
                }
            }
        }
        $request->merge([
            'project_id' => $project->id,
            'guest' => (Auth::check())? 0 : 1,
            'state' => 1
        ]);

        if(Auth::check()){
            $request->merge([
                'author' => Auth::user()->id,
            ]);
        }
        $fields = $request->all();

        $fields['images'] = (isset($imagesStored))? serialize($imagesStored) : '';


        Bug::create($fields);

        Session::flash('message', trans('bug.success'));
        return redirect()->action('BugController@index', ['projectSlug' => $projectSlug]);
    }

    /**
     * Add image(s) to a bug
     * @param string $projectSlug
     * @param object $image
     */
    public function addImage(Request $request, $projectSlug, $id)
    {
        $bug = Bug::find($id);
        $savedImages = (empty($bug->images))? array() : unserialize($bug->images);
        if($request->hasFile('images')){
            $images = $request->file('images');
            $imagesStored = [];
            foreach ($images as $key => $image) {
                $rules = array('file' => 'image|max:500');
                $validator = Validator::make(array('file'=> $image), $rules);
                if($validator->passes()) {
                    $filename = $this->saveImage($projectSlug, $image);
                    $imagesStored[] = $filename;
                    
                } else {
                    // redirect back with errors.
                    return Response::json($validator->getMessageBag()->toArray(), 422);
                }
            }
            if(isset($imagesStored)){
                $bug->images = serialize(array_merge($savedImages,$imagesStored));
                $bug->save();
                $data = [
                    'view' => View::make('bugs.images', compact('bug'))
                    ->render(),
                    'selector' => '.images .wrapper'
                ];
            }
        }
        return Response::json($data);
    }

    /**
     * Resize, save and create a thumbnail for a bug image
     * @param string $projectSlug
     * @param object $image
     * @return string $filename
     */
    public function saveImage($projectSlug, $image)
    {
        // Directories creation
        $destinationPath = 'uploads/screenshots/';
        $destinationPathThumbs = 'uploads/screenshots/thumbnails/';
        if(!File::isDirectory($destinationPathThumbs))
            File::makeDirectory($destinationPathThumbs,  0775, true);
        
        // Saving image
        $filename = $projectSlug . '-screenshot-' . uniqid() . '.' . $image->getClientOriginalExtension();
        $upload_success = $image->move($destinationPath, $filename);

        // Resize image 
        $imageresize = $imageThumb = Image::make($destinationPath.$filename);
        $imageresize->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $imageresize->save();

        // Generating thumbnail
        $imageThumb->resize(200, 150)->save($destinationPathThumbs . $filename);

        return $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $projectSlug
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectSlug, $id)
    {
        $project = Project::slug($projectSlug);
        $bug = Bug::find($id); 
        return View::make('bugs.show', compact('project', 'bug'));
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
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $projectSlug, $id)
    {
        $bug = Bug::find($id);
        $bug->delete();
        
        if($request->ajax()){
            return Response::json($id);
        }else{
            Session::flash('message', trans('bug.deleted_bug'));
            Redirect::action('BugController@index', [$projectSlug]);
        }
    }

    /**
     * Search through bug names.
     * @param string $projectSlug
     */
    public function search($projectSlug)
    {
        $term = Input::get('bug');
        $project = Project::slug($projectSlug);

        if(is_null($term))
            return Response::json(trans('bug.no_result'));

        $bugs = DB::table('bugs')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->where('project_id', $project->id)
            ->get();
        
        $data = array();
        if(count($bugs)){
            // Parsing the date that curiously, is no more a Carbon object here.
            foreach ($bugs as $key => $bug) {
                $bug->created_at = Carbon::parse($bug->created_at);
            }
            $data['html'] = View::make('bugs.list', compact('project', 'bugs'))->render();
        }
        else {
            $data['html'] = trans('bug.no_result');
        }

        return Response::json($data);
    }
}
