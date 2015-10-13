@extends('app')
@section('title', trans('project.list_title'))
@section('content')
	<h1>{!! trans('project.list_h1') !!}</h1>
	@include('projects.form-search')

  <ul>
  @foreach ($projects as $project)
    <li><a href="{!! route('project.show', $project->slug) !!}">{{ $project->name }}</a></li>
  @endforeach
  </ul>
@endsection