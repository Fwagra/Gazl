@extends('app')
@section('title', trans('contacts.list_title'))
@section('content')
	<h1>{!! trans('contacts.list_h1') !!}</h1>
  <ul>
  @foreach ($contacts as $contact)
    <li><a href="?">{{ $contact->name }}</a></li>
  @endforeach
  </ul>
@endsection
