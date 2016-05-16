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
