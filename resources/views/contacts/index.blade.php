@extends('app')
@section('title', trans('contacts.list_title'))
@section('content')
	<h1>{!! trans('contacts.list_h1') !!}</h1>
    <a href="{{ action('ContactController@create', $project->slug) }}">{!! trans('contacts.new_contact_action') !!}</a>
    <div class="contacts-list">
	@foreach ($contacts as $contact)
		<div class="contact">
			<ul class="infos">
				<li class="name"><a href="{{ action('ContactController@show', [$project->slug, $contact->id]) }}">{{ $contact->name }}</a></li>
				<li class="email">{{ $contact->email }}</li>
				<li class="phone">{{ $contact->phone }}</li>
			</ul>
			<div class="actions">
				<a href="{{ action('ContactController@edit', [$project->slug, $contact->id]) }}">{!! trans('contacts.edit_contact_action') !!}</a>
				<a href="{{ action('ContactController@destroy', [$project->slug, $contact->id]) }}">{!! trans('contacts.delete_contact_action') !!}</a>
			</div>
		</div>
	@endforeach
</div>
@endsection
