@extends('app')
@section('title', trans('doc.doc_title'))
@section('content')
	<h1>{!! trans('doc.form_h1') !!}</h1>@if (isset($doc->id))
		<a class="btn btn-success" href="{{ action('DocumentationController@index', [$project->slug]) }}">{!! trans('doc.view') !!}</a>
	@endif
  {!! Form::model($doc, ['method' => 'PUT', 'url' => action('DocumentationController@update', $project->slug), 'class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::textarea('md_value', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '40']) !!}
        <small class="text-danger">{{ $errors->first('md_value') }}</small>
    </div>
		<div class="form-group">
		    <div class="checkbox">
		        <label for="active">
								{!! Form::hidden('active', false) !!}
		            {!! Form::checkbox('active', true, $active, ['id' => 'active']) !!} {!! trans('doc.publish') !!}
		        </label>
		    </div>
		    <small class="text-danger">{{ $errors->first('checkbox_id') }}</small>
		</div>
    <div class="btn-group pull-right">
        {!! Form::submit(trans('doc.save'), ['class' => 'btn btn-success']) !!}
    </div>
  {!! Form::close() !!}
	@if($doc != null)
	  {!! Form::open(['method' => 'DELETE', 'url' => action('DocumentationController@destroy', $project->slug), 'class' => 'form-horizontal delete-form']) !!}
	      <div class="btn-group pull-right">
	          {!! Form::submit(trans('doc.delete'), ['class' => 'btn btn-danger pull-right']) !!}
	      </div>
	  {!! Form::close() !!}
	@endif

  <script type="text/javascript">
    $('.delete-form').on('submit', function(){
			if(!confirm('{!! trans('doc.delete_message') !!}'))
				return false;
		});
  </script>
@endsection
