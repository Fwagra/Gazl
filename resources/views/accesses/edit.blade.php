@extends('app')
@section('content')
    @include('errors.form-error')
	{!! Form::model($access, ['route' => ['project.access.update', $project->slug, $access], 'method' => 'PUT']) !!}
		@include('accesses.form')
    {!!  Form::close() !!}
    {!! Form::model($project, ['route' => ['project.access.destroy', $project->slug, $access], 'method' => 'DELETE']) !!}
		<div class="form-group">
		    {!! Form::submit(trans('access.delete'), ['class' => 'btn btn-primary'])!!}
		</div>
    {!!  Form::close() !!}
@endsection