@extends('app')
@section('title', trans('contacts.list_title'))
@section('content')
@if (isset($project))
	<h1>{!! trans('contacts.list_for_project_h1') !!}</h1>
@else
	<h1>{!! trans('contacts.list_h1') !!}</h1>
@endif
	<a href="{{ action('ContactController@create') }}">{!! trans('contacts.new_contact_action') !!}</a>
    <div class="contacts-list">
	@foreach ($contacts as $contact)
		<div class="contact">
			@if (isset($project))
				<a href="{{ action('ContactController@starrify', [$project->slug,$contact->id]) }}">{!! trans('contacts.starrify_action') !!}</a>
			@endif
			<ul class="infos">
				<li class="name"><a href="{{ action('ContactController@show', $contact->id) }}">{{ $contact->name }}</a></li>
				<li class="email">{{ $contact->email }}</li>
				<li class="phone">{{ $contact->phone }}</li>
			</ul>
			<div class="actions">
				<a href="{{ action('ContactController@edit', $contact->id) }}">{!! trans('contacts.edit_contact_action') !!}</a>
			</div>
		</div>
	@endforeach
</div>
@endsection
