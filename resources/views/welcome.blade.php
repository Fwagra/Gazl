@extends('app')
@section('title', 'Welcome')

@section('content')
                <div class="title">Laravel 5</div>
                {{ Auth::check()}}
                {{Auth::logout()}}
@endsection