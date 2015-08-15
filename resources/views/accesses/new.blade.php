@extends('app')
@section('content')
    @include('errors.form-error')
	{!! Form::open(['url' => route('project.access.store')]) !!}
		@include('accesses.form')
    {!!  Form::close() !!}
@endsection