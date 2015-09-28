@extends('app')
@section('title', trans('admin.title_admin'))
@section('content')
   <h1>{{ trans('admin.title_h1') }}</h1>
   @include('admin.blocks.projects')
   @include('admin.blocks.keys')
   @include('admin.blocks.users')
   @include('admin.blocks.checklist')
@endsection