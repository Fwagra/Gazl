@extends('mockup-base')
@section('title', trans('mockup.view_title'))
@section('content')
	<img src="/uploads/mockups/{{ $mockup->images }}" style="width:100%; height:auto;" />
	<div class="navbar">
		<div class="reveal"></div>
		<div class="name">{{ $mockup->name }}</div>
		@if ($previous != null)
			<div class="prev">
				<a href="{{ route('project.mockup.show', [$project->slug, $previous->id])}}">{!! trans('mockup.previous_link') !!}</a></div>
		@endif
		@if ($next != null)
			<div class="next">
				<a href="{{ route('project.mockup.show', [$project->slug, $next->id])}}">{!! trans('mockup.next_link') !!}</a></div>
			</div>
		@endif
		<div class="desc">{{ $mockup->description }}</div>
		<div class="back">
			<a href="{{ route('project.mockup-category.show', [$project->slug, $mockup->mockup_category_id]) }}">{!! trans('mockup.back_link') !!}</a>
		</div>
	</div>
@endsection
