<!-- resources/views/auth/register.blade.php -->
@extends('app')
@section('title', 'Register')
@section('content')
<div class="register-block col-center-block col-md-4">
    <h2>{{ trans('auth.register')}}</h2>
    {!! Form::open() !!}
        {!! csrf_field() !!}
        <div>
            Name

            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>
    
        <div>
            Email
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>
    
        <div>
            Password
            <input class="form-control" type="password" name="password">
        </div>
    
        <div>
            Confirm Password
            <input class="form-control" type="password" name="password_confirmation">
        </div>
    
        <div>
            <button type="submit">Register</button>
        </div>
    {!!  Form::close() !!}
</div>
@endsection