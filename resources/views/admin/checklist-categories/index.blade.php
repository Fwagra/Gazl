@extends('app')
@section('title', trans('checklist.list_categories'))
@section('content')
   <h1>{{ trans('checklist.list_categories') }}</h1>

   	<ul class='sortable list-group'>
   	   @foreach($categories as $category)
   	   <li class="list-group-item" id="{{ $category->id }}"><i>grab</i> {{ $category->name }}</li>
   	   @endforeach
   	</ul>
   	
   	<button class="btn btn-primary">{{ trans('checklist.add_category') }}</button>
@endsection

@section('footer_js')
	<script>
		jQuery(document).ready(function($) {
		    $('.sortable').sortable({
		        cursor: 'move',
		        axis: 'y',
		        handle: 'i',
		        update: function (event, ui) {
		            var order = $(this).sortable('toArray');
		            $.post('{{ route("sort.categories") }}', { order: order, "_token":"{{ csrf_token() }}" });
		        }
		    });
		});
	</script>
@endsection