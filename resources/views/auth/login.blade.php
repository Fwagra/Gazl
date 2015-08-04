<!-- resources/views/auth/login.blade.php -->
@extends('app')
@section('title', trans('auth.login'))
@section('content')
<div class="register-block col-center-block col-md-4">
    <h2>{{ trans('auth.login')}}</h2>
    @include('errors.form-error')
    {!! Form::open() !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('email', trans('auth.email'))!!}
            {!! Form::email('email',  old('email'), ['class' => 'form-control', 'placeholder' => trans('auth.email')])!!}
        </div>
        <div class="form-group">
            {!! Form::label('password', trans('auth.password'))!!}
            {!! Form::password('password',['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('remember', trans('auth.remember')) !!} {!! Form::checkbox('remember', null) !!}
        </div>
        <div class="form-group">
            {!! Form::submit(trans('auth.submit'), ['class' => 'btn btn-primary'])!!}
        </div>
    {!!  Form::close() !!}
    
</div>
@endsection