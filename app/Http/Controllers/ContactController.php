<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Database\Eloquent\Collection;
use Redirect;
use Session;
use View;
use Auth;

class ContactController extends Controller
{

    /**
     * Construct method
     */
    public function __construct() {
      $this->middleware('guest.auth', ['only' => ['index']]);
      $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display all the contacts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::All();
        return View::make('contacts.index', compact('contacts'));
    }
    /**
     * Display the project's contacts only
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function contactForProject(Project $project)
    {
        $contacts = $project->contacts;
        return View::make('contacts.index', compact('project', 'contacts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Contact $contact
     * @return View
     */
    public function show(Contact $contact)
    {
        return View::make('contacts.show', compact('contact'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @param Project $project
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        // We will need the projects list
        $projects = Project::All();
        return View::make('contacts.new', compact('projects'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @param Project $project
    * @return \Illuminate\Http\Response
    */
    public function createForProjet(Project $project)
    {
        // We will need the projects list
        $projects = Project::All();
        $linked_projects = new Collection;
        $linked_projects->push($project);

        return View::make('contacts.new', compact('projects','project','linked_projects'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  Contact  $contact
    * @return View
    */
    public function edit(Contact $contact)
    {
        // We will need the projects list
        $projects = Project::All();
        $linked_projects = $contact->projects;
        return View::make('contacts.edit', compact('projects','contact','linked_projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
         $this->validate($request, [
             'name' => 'required|max:255',
             'email' => 'required|max:255',
         ]);

         $fields = $request->all();

         $contact = Contact::create($fields);
         // Sync updates the relationships in the contact-project table
         $contact->projects()->sync($fields['projects']);

         Session::flash('message', trans('contacts.added_contact'));
         return redirect()->back();
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Contact $contact
     * @return Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        $fields = $request->all();
        $contact->update($fields);
        // Sync updates the relationships in the contact-project table
        $contact->projects()->sync($fields['projects']);

        Session::flash('message', trans('contacts.edited_contact'));
        return redirect()->back();
    }

    /**
     * Remove the category and the attached items
     *
     * @param  string  $projectSlug
     * @param  Contact $contact
     * @return Response
     */
    public function destroy(Request $request, Contact $contact)
    {
        $contact->delete();

        if($request->ajax()){
            return Response::json($contact->id);
        }else{
            Session::flash('message', trans('contacts.deleted_contact'));
            return redirect()->action('ContactController@index');
        }
    }

    /**
     * Set client to "starred" status for current project
     *
     * @param  string  $projectSlug
     * @param  Contact $contact
     * @return Response
     */
    public function starrify(Project $project, Contact $contact)
    {
        // From all client's projects, starrify only the current one (from url)
        $contact->projects()->sync([$project->id => ['is_starred' => 1]], false);

        Session::flash('message', trans('contacts.starrified_contact'));
        return back();
    }
    /**
     * Set client to "unstarred" status for current project
     *
     * @param  string  $projectSlug
     * @param  Contact $contact
     * @return Response
     */
    public function unstarrify(Project $project, Contact $contact)
    {
        // From all client's projects, starrify only the current one (from url)
        $contact->projects()->sync([$project->id => ['is_starred' => 0]], false);

        Session::flash('message', trans('contacts.unstarrified_contact'));
        return back();
    }
}
