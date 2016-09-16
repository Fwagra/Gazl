<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
     * Display the projects contacts if there is at least one
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $contacts = $project->contacts;

        if($contacts != null)
        {
          return View::make('contacts.index', compact('project', 'contacts'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @param  Bug $bug
     * @return View
     */
    public function show(Project $project, Contact $contact)
    {
        return View::make('contacts.show', compact('project', 'contact'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @param Project $project
    * @return \Illuminate\Http\Response
    */
    public function create(Project $project)
    {
        return View::make('contacts.new', compact('project'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  Project $project
    * @param  Bug  $bug
    * @return View
    */
    public function edit(Project $project, Contact $contact)
    {
        return View::make('contacts.edit', compact('project', 'contact'));
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
             'email' => 'required|max:255',
         ]);

         $fields = $request->all();

         $contact = Contact::create($fields);
         Event::fire(new NewContact($contact));

         Session::flash('message', trans('contacts.added_contact'));
         return redirect()->action('ContactController@index', ['projectSlug' => $project->slug]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Project $project
     * @param  Contact $contact
     * @return Response
     */
    public function update(Request $request, Project $project, Contact $contact)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        $fields = $request->all();
        $contact->update($fields);

        Session::flash('message', trans('contacts.edited_contact'));
        return redirect()->action('ContactController@index', ['projectSlug' => $project->slug]);
    }

    /**
     * Remove the category and the attached items
     *
     * @param  string  $projectSlug
     * @param  Project $project
     * @param  Contact $contact
     * @return Response
     */
    public function destroy(Request $request, Project $project, Contact $contact)
    {
        $contact->delete();

        if($request->ajax()){
            return Response::json($contact->id);
        }else{
            Session::flash('message', trans('contacts.deleted_contact'));
            return back();
        }
    }
}
