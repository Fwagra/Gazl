@extends('app')
@section('title', trans('doc.doc_title'))
@section('content')
	<h1>{!! trans('doc.form_h1') !!}</h1>
  {!! Form::model($doc, ['method' => 'PUT', 'url' => action('DocumentationController@update', $project->slug), 'class' => 'form-horizontal']) !!}
  <div class="form-group">
      {!! Form::textarea('md_value', null, ['class' => 'form-control', 'required' => 'required']) !!}
      <small class="text-danger">{{ $errors->first('md_value') }}</small>
  </div>
      <div class="btn-group pull-right">
          {!! Form::submit(trans('doc.save'), ['class' => 'btn btn-success']) !!}
      </div>

  {!! Form::close() !!}
@endsection
