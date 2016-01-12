@extends('app')
@section('title', trans('bug.list_title'))
@section('content')
	<h1>{!! trans('bug.list_h1') !!}</h1>
	@include('bugs.navbar')
	<div class="bug-content">
		@if (count($bugs))
			@include('bugs.list')
		@endif
	</div>
	{!! $bugs->appends(Input::except('page'))->render(); !!}
	
@endsection