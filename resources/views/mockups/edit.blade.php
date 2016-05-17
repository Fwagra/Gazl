@extends('app')
@section('title', trans('mockup.edit_title'))
@section('content')
	<h1>{!! trans('mockup.edit_h1') !!}</h1>
	@include('errors.form-error')
	{!! Form::model($mockup, ['url' => action('MockupController@update', [$project->slug, $mockup->id]), 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
		@include('mockups.form')
  {!!  Form::close() !!}
  <script type="text/javascript">
    jQuery('.select2').select2({
      tags: true
    });
  </script>
@endsection
@section('footer_js')
	<script type="text/javascript">
	var config = {
		routes: [{
			delete: "{{ action('MockupController@deleteImage', [$project->slug, $mockup->id ])}}"
		}],
		others: [{
			csrf: "{{ csrf_token() }}",
			deletemsg: "{{ trans('global.deletemsg') }}"
		}]
	}
	$(document).on('click', '.delete-element', function(event){
		event.preventDefault();
	    if(confirm(config.others[0].deletemsg)) {
			var route = config.routes[0].delete + '/' + $(this).attr('data-type');
	        $.ajax({
	    		url: route,
				type:'POST',
				data: {
	               "_token": config.others[0].csrf
			   }
			})
	    	.done(function(id) {
				if (id != false) {
					$('span[data-type="'+id+'"]').remove();
				}
	    	});
	    }
	});
	</script>
@endsection
