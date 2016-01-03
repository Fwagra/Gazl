@extends('app')
@section('title', trans('bug.list_title'))
@section('content')
	<h1>{!! trans('bug.list_h1') !!}</h1>
	@foreach ($bugs as $bug)
		{{ $bug->name }}
	@endforeach
	<a href="{{ action('BugController@create', $project->slug) }}">{{ trans('bug.add_bug') }}</a>
@endsection