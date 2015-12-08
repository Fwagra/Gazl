@extends('app')
@section('title', trans('checklist.list_points'))
@section('content')
    <h1>{{ trans('checklist.list_points') }}</h1>
    @if ($categories)
        <ul class='sortable list-group'>
            @include('admin.checklist-points.list')
        </ul>    
    @endif
@endsection

@section('footer_js')
	
@endsection