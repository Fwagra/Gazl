@extends('app')
@section('title', $category->name)
@section('content')
	<h1>{{ $category->name }}</h1>
	<div class="sortable panel panel-default list-group">
		@forelse ($mockups as $mockup)
			<div class="list-group-item {{ $mockup->color }}" data-id="{{ $mockup->id }}">
				<i class=" glyphicon glyphicon-th"></i>
				<span class="format-{{ $mockup->format }}"></span>
				<a class="name" href="{{ action('MockupController@show', [$project->slug, $mockup->id]) }}">{{ $mockup->name }}</a>
				{!! Form::open(['url' => action('MockupController@destroy', [$project->slug, $mockup->id]), 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
					<div class="form-group">
					    {!! Form::submit('×', ['class' => 'close'])!!}
					</div>
			    {!!  Form::close() !!}
			</div>
		@empty
			{!! trans('mockup.no_mockups') !!}
		@endforelse
	</div>
	<a href="{{ action('MockupController@create', [$project->slug])}}" class="btn btn-primary">{!! trans('mockup.create_mockup') !!}</a>
@endsection
@section('footer_js')
	<script>
		var config = {
			routes: [{
				sort: '{{ route("sort.mockup") }}',
			}],
			others: [{
				csrf: "{{ csrf_token() }}",
				deletemsg: "{{ trans('mockup.delete_mockup_msg') }}"
			}]
		}
	</script>
	{!! Html::script('js/list_management_ajax.js'); !!}
@endsection
