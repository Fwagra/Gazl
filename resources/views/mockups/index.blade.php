@extends('app')
@section('title', trans('mockup.mockup_index_title'))
@section('content')
	<h1>{!! trans('mockup.mockup_index_h1') !!}</h1>
	<div class="sortable panel panel-default list-group">
		@forelse ($categories as $category)
			<div class="list-group-item" data-id="{{ $category->id }}">
				@if (Auth::check())
					<i class=" glyphicon glyphicon-th"></i>
				@endif
				<a class="name" href="{{ action('MockupCategoryController@show', [$project->slug, $category->id]) }}">{{ $category->name }}</a>
				@if (Auth::check())
					<a class="edit" href="{{ action('MockupCategoryController@edit', [$project->slug, $category->id])}}">{!! trans('mockup.edit') !!}</a>
					{!! Form::open(['url' => action('MockupCategoryController@destroy', [$project->slug, $category->id]), 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
						<div class="form-group">
						    {!! Form::submit('×', ['class' => 'close'])!!}
						</div>
				    {!!  Form::close() !!}
				@endif
			</div>
		@empty
			{!! trans('mockup.no_categories') !!}
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
				sort: '{{ route("sort.mockup-category") }}',
			}],
			others: [{
				csrf: "{{ csrf_token() }}",
				deletemsg: "{{ trans('mockup.delete_category_msg') }}"
			}]
		}
	</script>
	{!! Html::script('js/list_management_ajax.js'); !!}
@endsection
