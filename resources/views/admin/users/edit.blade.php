@extends('app')
@section('title', trans('user.user_edit_admin_title'))
@section('content')
    <h1>{{ trans('user.user_edit_admin_h1') }}</h1>
    @include('admin.users.form')
    {!! Form::model($user, ['route' => ['admin.user.destroy', $user], 'method' => 'DELETE']) !!}
		<div class="form-group">
		    {!! Form::submit(trans('user.delete'), ['class' => 'btn btn-primary delete-confirm']) !!}
		</div>
    {!!  Form::close() !!}
@endsection
