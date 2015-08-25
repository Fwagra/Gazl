@extends('app')
@section('title', trans('access.title_new_access'))
@section('content')
    @include('errors.form-error')
	{!! Form::open(['url' => route('project.access.store', $project)]) !!}
		@include('accesses.form')
    {!!  Form::close() !!}
@endsection