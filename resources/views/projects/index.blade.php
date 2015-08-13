@extends('app')
@section('title', trans('project.list_title'))
@section('content')
	<h1>{!! trans('project.list_h1') !!}</h1>
	@include('projects.form-search')
@endsection