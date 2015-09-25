@extends('app')
@section('title', $project->name)
@section('content')
	<h1>{{ $project->name }}</h1>
	@include('dashboard.accesses')
@endsection
@section('info_head')
	<span class="label float label-primary">{{ $project->public_id }}</span>
@endsection