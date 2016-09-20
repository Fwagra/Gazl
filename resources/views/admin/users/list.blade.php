@extends('app')
@section('title', trans('user.user_admin_title'))
@section('content')
    <h1>{{ trans('user.user_admin_h1') }}</h1>
    <div class="list-users">
        <ul class="list-group">
            @foreach ($users as $user)
                <li class="list-group-item">
                    <a href="{{ action('UserController@edit', $user->id) }}">{{ $user->first_name . ' ' . $user->name }}</a> 
                </li>
            @endforeach
        </ul>
    </div>
@endsection
