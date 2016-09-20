@extends('app')
@section('title', trans('user.user_edit_admin_title'))
@section('content')
    <h1>{{ trans('user.user_edit_admin_h1') }}</h1>
    @include('admin.users.form')
@endsection
