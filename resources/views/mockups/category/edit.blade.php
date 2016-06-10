@extends('app')
@section('title', trans('mockup.edit_cat_title'))
@section('content')
	<h1>{!! trans('mockup.edit_cat_h1') !!}</h1>
	@include('errors.form-error')
	{!! Form::model($category, ['url' => action('MockupCategoryController@update', [$project->slug, $category->id]),  'method' => 'PUT']) !!}
		<div class="form-group">
		    {!! Form::label('name', trans('mockup.category_label')) !!}
		    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
		    <small class="text-danger">{{ $errors->first('name') }}</small>
		</div>
        {!! Form::submit(trans('mockup.submit'), ['class' => 'btn btn-info pull-right']) !!}
    {!!  Form::close() !!}
@endsection
