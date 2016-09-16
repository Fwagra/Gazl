@extends('app')
@section('title', trans('user.user_admin_title'))
@section('content')
    <h1>{{ trans('user.user_admin_h1') }}</h1>
    <div class="list-users">
        <ul class="list-group">
            @forelse ($users as $user)
                <li class="list-group-item">
                    {{ $user->first_name . ' ' . $user->name }}
                </li>
            @empty
                <li class="list-group-item">{{ trans('user.no_user_list') }}</li>
            @endforelse
        </ul>
    </div>
@endsection
