<!-- resources/views/auth/login.blade.php -->
@extends('app')
@section('title', trans('auth.login'))
@section('content')
<div class="register-block col-center-block col-md-4">
    <h2>{{ trans('auth.login')}}</h2>
    @include('errors.form-error')
    @include('auth.form')
    
</div>
@endsection