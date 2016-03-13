@extends('app')
@section('title', "#". $bug->id.' '.$bug->name)
@section('content')
	<h1>{!! "#". $bug->id.' '.$bug->name  !!}</h1>
	@include('errors.form-error')
	{!! Form::model($bug, ['url' => action('BugController@update', [$project->slug, $bug->id]), 'method' => 'PUT']) !!}
		@include('bugs.form')
    {!!  Form::close() !!}    
@endsection