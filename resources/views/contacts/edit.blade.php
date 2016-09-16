@extends('app')
@section('title', "#". $contact->id.' '.$contact->name)
@section('content')
	<h1>{!! $contact->name !!}</h1>
	@include('errors.form-error')
	{!! Form::model($contact, ['url' => action('ContactController@update', [$project->slug, $contact->id]), 'method' => 'PUT']) !!}
		@include('contacts.form')
    {!!  Form::close() !!}
@endsection
