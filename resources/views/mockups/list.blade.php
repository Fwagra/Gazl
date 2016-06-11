@extends('app')
@section('title', $category->name)
@section('content')
	<h1>{{ $category->name }}</h1>
	<div class="sortable panel panel-default list-group">
		@forelse ($mockups as $mockup)
			<div class="list-group-item {{ $mockup->color }}" data-id="{{ $mockup->id }}">
				@if (Auth::check())
					<i class=" glyphicon glyphicon-th"></i>
				@endif
				<span class="format-{{ $mockup->format }}"></span>
				<a class="name" href="{{ action('MockupController@show', [$project->slug, $mockup->id]) }}">{{ $mockup->name }}</a>
				@if (Auth::check())
					<a class="edit" href="{{ action('MockupController@edit', [$project->slug, $mockup->id])}}">{!! trans('mockup.edit') !!}</a>

					{!! Form::open(['url' => action('MockupController@destroy', [$project->slug, $mockup->id]), 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
						<div class="form-group">
						    {!! Form::submit('×', ['class' => 'close'])!!}
						</div>
				    {!!  Form::close() !!}
				@endif
			</div>
		@empty
			{!! trans('mockup.no_mockups') !!}
		@endforelse
	</div>
	@if (Auth::check())
		<a href="{{ action('MockupController@create', [$project->slug])}}" class="btn btn-primary">{!! trans('mockup.create_mockup') !!}</a>
	@endif
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
