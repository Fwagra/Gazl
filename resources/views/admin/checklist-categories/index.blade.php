@extends('app')
@section('title', trans('checklist.list_categories'))
@section('content')
   <h1>{{ trans('checklist.list_categories') }}</h1>

   	<ul class='sortable list-group'>
   		@include('admin.checklist-categories.list')
   	</ul>
   	{!! Form::open(['route' => 'admin.checklist-category.store', 'id' => 'add_category']) !!}
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
		jQuery(document).ready(function($) {
		    $('.sortable').sortable({
		        cursor: 'move',
		        axis: 'y',
		        handle: 'i',
		        update: function (event, ui) {
		            var order = $(this).sortable('toArray',	{attribute: 'data-id'});
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
			            $('.list-group').html(data.view);
			            $('input[type="text"],textarea').val('');
			        },
			        'json'
			    ).fail(function(data) {
				    errorsHtml = '<div class="alert alert-danger"><ul>';
				    $.each( data.responseJSON, function( key, value ) {
				        errorsHtml += '<li>' + value[0] + '</li>';
				    });
				    errorsHtml += '</ul></diV>';
				    $('.errors').html(errorsHtml);
				});
		});
	</script>
@endsection