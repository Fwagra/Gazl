@extends('email.base')
@section('title')
	{{ trans('email.new_bugcomment_name', ['id' => $bug->id, 'title' => $bug->name]) }}
@endsection
@section('content')
	<div class="desc">
		<div class="author">{{ trans('email.published_by') }} {{ $comment->name }}</div>
		<p>
			{{ $comment->comment }}
		</p>
	</div>
	{{ trans('email.click_here_to_see_bug') }}
	{!! link_to_route('project.bug.show', trans('email.link_to_bug'), [$project->slug, $bug->id]) !!}
@endsection
