@extends('app')
@section('title', $project->name)
@section('content')
	<h1>{{ $project->name }}</h1>
	@include('dashboard.accesses')
	@include('dashboard.checklist')
	@include('dashboard.bugs')
@endsection
