@extends('app')
@section('content')
<div class="login-guest-block col-center-block col-md-4">
    <h2>{{ trans('auth.login')}}</h2>
    @include('errors.form-error')
    <div class="login">
    	@include('auth.form')
	</div>
    <div class="guest">
    	@include('home.guest-form')
    </div>
</div>
@endsection