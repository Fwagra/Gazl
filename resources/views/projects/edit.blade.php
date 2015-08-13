@extends('app')
@section('content')
    @include('errors.form-error')
	{!! Form::model($project, ['route' => ['project.update', $project->slug], 'method' => 'PUT']) !!}
		@include('projects.form')
    {!!  Form::close() !!}
@endsection