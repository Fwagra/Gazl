@extends('email.base')
@section('title')
	{{ trans('email.new_bug_name', ['id' => $bug->id, 'title' => $bug->name]) }}
@endsection
@section('content')
	<ul>
		<li>
			<span>{{ trans('bug.reported_on') }}</span>
			{{ $bug->created_at->format('d-m-Y') }}
		</li>
		<li>
			<span>{{ trans('bug.author_bug') }} : </span>
			{{ $bug->author }}
		</li>
		@if ($bug->email)
			<li>
				<span>{{ trans('bug.email') }} : </span>
				{{ $bug->email }}
			</li>
		@endif
		@if ($bug->url)
			<li>
				<a href="{{ $bug->url }}">{{ trans('email.bug_linked_url') }}</a>
			</li>
		@endif
	</ul>
	<div class="desc">
		<h3>{{ trans('bug.description') }}</h3>
		<p>
			{{ $bug->description }}
		</p>
	</div>
	{{ trans('email.click_here_to_see_bug') }}
	{!! link_to_route('project.bug.show', trans('email.link_to_bug'), [$project->slug, $bug->id]) !!}
@endsection