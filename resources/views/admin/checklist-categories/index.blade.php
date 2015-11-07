@extends('app')
@section('title', trans('checklist.list_categories'))
@section('content')
   <h1>{{ trans('checklist.list_categories') }}</h1>

   	<ul class='sortable list-group'>
   	   @foreach($categories as $category)
   	   <li class="list-group-item" data-id="{{ $category->id }}"><i>grab</i> {{ $category->name }}</li>
   	   @endforeach
   	</ul>
   	{!! Form::open(['route' => 'admin.checklist-category.store', 'id' => 'add_category']) !!}
    	{!! csrf_field() !!}
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
		jQuery(document).ready(function($) {
		    $('.sortable').sortable({
		        cursor: 'move',
		        axis: 'y',
		        handle: 'i',
		        update: function (event, ui) {
		            var order = $(this).sortable('toArray',	{attribute: 'data-id'});
		            console.log(order);
		            $.post('{{ route("sort.categories") }}', { order: order, "_token":"{{ csrf_token() }}" });
		        }
		    });
		});
		$(document).on('submit', '#add_category', function(event){
			event.preventDefault();
				$.post(
			        $(this).prop( 'action' ),
			        $(this).serialize(),
			        function(data) {
			             console.log(data);
			        },
			        'json'
			    );
		});
	</script>
@endsection