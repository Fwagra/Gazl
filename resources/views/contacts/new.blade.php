@extends('app')
@section('title', trans('contacts.create_title'))
@section('content')
	<h1>{!! trans('contacts.create_h1') !!}</h1>
	@include('errors.form-error')
	{!! Form::open(['url' => action('ContactController@store', $project->slug)]) !!}
		@include('contacts.form')
    {!!  Form::close() !!}
@endsection
