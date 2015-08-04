<!-- resources/views/auth/register.blade.php -->
@extends('app')
@section('title', 'Register')
@section('content')
<div class="register-block col-center-block col-md-4">
    <h2>{{ trans('auth.register')}}</h2>
    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
    @endif

    {!! Form::open() !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('name', trans('auth.name'))!!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('auth.name')])!!}
        </div>
        <div class="form-group">
            {!! Form::label('first_name', trans('auth.first_name'))!!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('auth.first_name')])!!}
        </div>
        <div class="form-group">
            {!! Form::label('email', trans('auth.email'))!!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('auth.email')])!!}
        </div>
        <div class="form-group">
            {!! Form::label('password', trans('auth.password'))!!}
            {!! Form::password('password',['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', trans('auth.password_confirmation'))!!}
            {!! Form::password('password_confirmation',['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::submit(trans('auth.submit'), ['class' => 'btn btn-primary'])!!}
        </div>
    {!!  Form::close() !!}
</div>
@endsection