@extends('app')
@section('title', trans('mockup.mockup_index_title'))
@section('content')
	<h1>{!! trans('mockup.mockup_index_h1') !!}</h1>
	<div class="sortable panel panel-default list-group">
		@forelse ($categories as $category)
			<div class="list-group-item" data-id="{{ $category->id }}">
				<i class=" glyphicon glyphicon-th"></i>
				<a class="name" href="{{ action('MockupCategoryController@destroy', [$project->slug, $category->id]) }}">{{ $category->name }}</a>
				{!! Form::open(['route' => ['project.mockup-category.destroy', $category->id], 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
					<div class="form-group">
					    {!! Form::submit('×', ['class' => 'close'])!!}
					</div>
			    {!!  Form::close() !!}
			</div>
		@empty
			{!! trans('mockup.no_categories') !!}
		@endforelse
	</div>
	<a href="{{ action('MockupController@create', [$project->slug])}}" class="btn btn-primary">{!! trans('mockup.create_mockup') !!}</a>
@endsection
@section('footer_js')
	<script>
		var config = {
			routes: [{
				sort: '{{ route("sort.mockup-category") }}',
			}],
			others: [{
				csrf: "{{ csrf_token() }}",
				deletemsg: "{{ trans('global.deletemsg') }}"
			}]
		}
	</script>
	{!! Html::script('js/list_management_ajax.js'); !!}
@endsection
