@extends('app')
@section('content')
    @include('errors.form-error')
	{!! Form::model($project, ['route' => ['project.update', $project->slug], 'method' => 'PUT']) !!}
		@include('projects.form')
    {!!  Form::close() !!}
    {!! Form::model($project, ['route' => ['project.destroy', $project->slug], 'method' => 'DELETE']) !!}
		<div class="form-group">
		    {!! Form::submit(trans('project.delete'), ['class' => 'btn btn-primary'])!!}
		</div>
    {!!  Form::close() !!}
@endsection