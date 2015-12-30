@extends('app')
@section('title', trans('bug.create_title'))
@section('content')
	<h1>{!! trans('bug.create_h1') !!}</h1>
	{!! Form::open(['url' => action('BugController@store', $project->slug), 'files' => true]) !!}
		@include('bugs.form')
    {!!  Form::close() !!}
@endsection