@extends('app')
@section('content')
    @include('errors.form-error')
	{!! Form::model($point, ['route' => ['admin.checklist-point.update', $point->id], 'method' => 'PUT']) !!}
		@include('admin.checklist-points.form')
    {!!  Form::close() !!}
@endsection