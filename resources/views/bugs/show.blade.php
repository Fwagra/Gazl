@extends('app')
@section('title', "#". $bug->id.' '.$bug->name )
@section('content')
	<h1>#{{ $bug->id }}  {{ $bug->name }}</h1>
	<div class="col-md-12">
		<div class="row">
			@if ($bug->url)
				<a href="{!! $bug->url !!}">URL</a>
			@endif
			<div class="group state">
				<span class="label">{{ trans('bug.bug_state') }}</span>
				<span class="value">{{ $bug->state }}</span>
			</div>
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
		<div class="images">
			<div class="wrapper">
				@include('bugs.images')
			</div>
			<div class="add_image">
			   	{!! Form::open(['route' => ['bug.image.add', $project->slug, $bug->id], 'id' => 'add_image', 'class' => 'add_element']) !!}
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
	</div>
@endsection