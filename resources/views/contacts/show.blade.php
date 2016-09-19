@extends('app')
@section('title', trans('contacts.contact_title') .' '. $contact->name )
@section('content')
    <h1>{{ $contact->name }}</h1>
    <div class="col-md-12">
        <div class="row">
            <a href="{{ action('ContactController@edit', $contact->id) }}">{{ trans('contacts.edit_contact_action') }}</a>
			<a href="{{ action('ContactController@destroy', $contact->id) }}">{!! trans('contacts.delete_contact_action') !!}</a>
            <div class="group email">
                <span class="label">{{ trans('contacts.email') }}</span>
                <span class="value">{{ $contact->email }}</span>
            </div>
            <div class="group phone">
                <span class="label">{{ trans('contacts.phone') }}</span>
                <span class="value">{{ $contact->phone }}</span>
            </div>
        </div>
        <div class="description">
            <span class="label">{{ trans('contacts.notes') }}</span>
            {{ $contact->notes }}
        </div>
        <div class="projets">
            <span class="label">{{ trans('contacts.projects') }}</span>
            <ul class="projects-list">
                @foreach ($contact->projects as $project)
                    <li>
                        <a href="{{ action('ProjectController@show', $project->slug) }}">
                            {{ $project->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
