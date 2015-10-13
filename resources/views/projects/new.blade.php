@extends('app')

@section('content')
  @include('errors.form-error')

	{!! Form::open(['url' => route('project.store')]) !!}
		@include('projects.form')
  {!!  Form::close() !!}
@endsection