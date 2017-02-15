@extends('app')
@section('title', "#". $bug->id.' '.$bug->name )
@section('content')
	@include('errors.form-error')
	<h1>#{{ $bug->id }}  {{ $bug->name }}</h1>
	<div class="col-md-12">
		<div class="row">
			@if ($bug->url)
				<a href="{!! $bug->url !!}">URL</a>
			@endif
			@if (Auth::check())
				<a href="{{ action('BugController@edit', [$project->slug, $bug->id]) }}">{{ trans('bug.edit_bug_infos') }}</a>
			@endif
			<div class="group author">
				<span class="label">{{ trans('bug.author_bug') }}</span>
				<span class="value">{{ $bug->author }}</span>
			</div>
			<div class="group email">
				<span class="label">{{ trans('bug.email') }}</span>
				<span class="value">{{ $bug->email }}</span>
			</div>
		</div>
		<div class="description">
			<div class="label">{{ trans('bug.description') }}</div>
			{{ $bug->description }}
		</div>
		@if (Auth::check())
			<div class="state">
				@include('bugs.state')
			</div>
		@endif
		<div class="images">
			<div class="wrapper">
				@include('bugs.images')
			</div>
			<div class="add_image">
			   	{!! Form::open(['route' => ['bug.image.add', $project->slug, $bug->id], 'files' => true, 'class' => 'add-element-image']) !!}
			    	<div class="errors"></div>
				   	<div class="input-group">
				   		<div class="form-group">
				   		    {!! Form::label('images', trans('bug.images'), ['data-toggle' =>"tooltip", 'data-original-title' => trans('bug.images_tooltip'), 'data-placement' => 'right'])!!}
				   		    {!! Form::file('images[]', ['multiple' => true])!!}
				   		</div>
					   	<div class="input-group-btn">
					   	 	{!! Form::submit(trans('bug.upload'), ['class' => 'btn btn-primary']) !!}
					   	</div>
				   	</div>
				{!!  Form::close() !!}
			</div>
		</div>
		<div class="comments row">
			<h2>{{ trans('bug.comments_title') }}</h2>
			<div class="list_comments">
				@include('bugs.comments.list')
			</div>
			<div class="form_comments">
				@include('bugs.comments.form')
			</div>
		</div>
	</div>
@endsection
@section('footer_js')
	<script>
		config.routes = {
			state: '{{ route("bug.state.change", [$project->slug, $bug->id]) }}'
		};
	</script>
@endsection
