@extends('app')
@section('title', trans('checklist.title_checklist'))
@section('content')
	<h1>{{ trans('checklist.title_checklist') }}</h1>
	@foreach ($categories as $category)
		<div class='panel panel-default list-group'>
			<div class="panel-heading">
				{!! $category->name !!}
			</div>
			@foreach ($category->points()->orderBy('order')->get() as $point)
				<?php
					$answer = isset($answers[$point->id])? $answers[$point->id] : false;
					$check = ($answer)? $answer->check : 0;
					$active = ($answer)? $answer->active : 1;
					$comment = ($answer)? $answer->comment : '';
					$commentClass = (empty($comment))? 'disabled' : '';
				?>
				@if (Auth::check())
					@include('checklist.auth-point')
				@else
					@if ($active)
						@include('checklist.guest-point')
					@endif
				@endif
			@endforeach
		</div>
	@endforeach
	@if (Auth::check())
		<a href="{{ action('ChecklistAnswerController@generatePdf',[$project->slug]) }}" class="btn btn-success">{!! trans('checklist.download_pdf') !!}</a>
	@endif
@endsection
@section('footer_js')
	<script>
		config.routes = {
			sort: '{{ route("sort.categories") }}',
			edit: '{{ route ("admin.checklist-category.update", "url_id") }}'
		}
	</script>
@endsection
