@extends('app')
@section('title', trans('checklist.list_categories'))
@section('content')
   <h1>{{ trans('checklist.list_categories') }}</h1>

   	<ul class='sortable list-group'>
   		@include('admin.checklist-categories.list')
   	</ul>
   	{!! Form::open(['route' => 'admin.checklist-category.store', 'id' => 'add_category', 'class' => 'add_ajax']) !!}
    	{!! csrf_field() !!}
    	<div class="errors"></div>
	   	<div class="input-group">
		   	{!!  Form::text('name', null, ['class' => 'form-control','id' => 'name', 'placeholder' => trans('checklist.new_category')]) !!}
		   	<div class="input-group-btn">
		   	 	{!! Form::submit(trans('checklist.add_category'), ['class' => 'btn btn-primary']) !!}
		   	</div>
	   	</div>
	{!!  Form::close() !!}
@endsection

@section('footer_js')
	<script>
		var config = {
			routes: [{ 
				sort: '{{ route("sort.categories") }}',
			}],
			others: [{
				csrf: "{{ csrf_token() }}"
			}]
		}
	</script>
	{!! Html::script('js/list_management_ajax.js'); !!}
@endsection