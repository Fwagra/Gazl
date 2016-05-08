@extends('app')
@section('title', trans('mockup.create_title'))
@section('content')
	<h1>{!! trans('mockup.create_h1') !!}</h1>
	@include('errors.form-error')
	{!! Form::open(['url' => action('MockupController@store', $project->slug), 'files' => true]) !!}
		@include('mockups.form')
  {!!  Form::close() !!}
  <script type="text/javascript">
    jQuery('.select2').select2({
      tags: true
    });
  </script>
  
@endsection
