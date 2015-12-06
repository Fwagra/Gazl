@extends('app')
@section('title', trans('checklist.list_points'))
@section('content')
   <h1>{{ trans('checklist.list_points') }}</h1>
	@foreach ($categories as $category)
		{!! $category->name !!}
		@foreach ($category->points()->orderBy('order')->get() as $point)
			{!! $point->name !!}
		@endforeach
	@endforeach
@endsection

@section('footer_js')
	
@endsection