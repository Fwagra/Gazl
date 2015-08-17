@extends('app')
@section('content')
    @include('errors.form-error')
	{!! Form::model($access, ['route' => ['project.access.update', $project->slug, $access], 'method' => 'PUT']) !!}
		@include('accesses.form')
    {!!  Form::close() !!}
@endsection