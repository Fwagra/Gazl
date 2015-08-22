@extends('app')
@section('title', trans('access.title_new_key'))
@section('content')
    @include('errors.form-error')
	{!! Form::open(['url' => route('key.save')]) !!}
		{!! csrf_field() !!}
		<div class="form-group">
		    {!! Form::label('key', trans('access.key'))!!}
		    {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => trans('access.key_enter')])!!}
		</div>
		<div class="form-group">
		    {!! Form::submit(trans('access.save_key'), ['class' => 'btn btn-primary'])!!}
		</div>
    {!!  Form::close() !!}
@endsection