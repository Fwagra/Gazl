@extends('app')
@section('title', trans('bug.list_title'))
@section('content')
	<h1>{!! trans('bug.list_h1') !!}</h1>
	@include('bugs.navbar')
	<div class="bug-content">
		@if (count($bugs))
			@include('bugs.list')
		@else
			<div class="well">
				{{ trans('bug.no_bugs') }}
			</div>
		@endif
	</div>
	{!! $bugs->appends(Input::except('page'))->render(); !!}

@endsection
@section('footer_js')
	<script>
		var config = {
			selectors: [{
				form: '.form-search',
				input: '#bug-input',
				replace:'.bug-content',
				reini:'.reini-btn',
			}],
			others: [{
				deletemsg: "{{ trans('global.deletemsg') }}",
			}],
		}
	</script>
@endsection
