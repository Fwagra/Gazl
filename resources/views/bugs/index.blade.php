@extends('app')
@section('title', trans('bug.list_title'))
@section('content')
	<h1>{!! trans('bug.list_h1') !!}</h1>
	@if (count($bugs))
		<ul class="list-group">
			@foreach ($bugs as $bug)
				<li class="list-group-item">
					<div class="md-1">{{ $bug->state }}</div>
					<div class="md-10">
						<a href="{{ action('BugController@show', [$project->slug, $bug->id]) }}"> {{ $bug->name }}</a>
						<span>{{ trans('bug.reported_on') }} {{ $bug->created_at }}</span>
					</div>
					<div class="md-1">{{ trans('bug.delete') }}</div>
				</li>
			@endforeach
		</ul>
	@endif
	{!! $bugs->appends(Input::except('page'))->render(); !!}
	<a href="{{ action('BugController@create', $project->slug) }}">{{ trans('bug.add_bug') }}</a>
@endsection