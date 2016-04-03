@extends('app')
@section('title', trans('memo.list_memos'))
@section('content')
   <h1>{{ trans('memo.list_memos') }}</h1>
	@if ($memos)
	   	<ul class='sortable list-group'>
	   		@include('memos.list')
	   	</ul>
	@endif
   	{!! Form::open(['route' => ['project.memo.store', $project->slug], 'id' => 'add_memo', 'class' => 'add_element']) !!}
    	{!! csrf_field() !!}
    	<div class="errors"></div>
	   	<div class="input-group">
		   	{!!  Form::text('name', null, ['class' => 'form-control','id' => 'name', 'placeholder' => trans('memo.new_memo')]) !!}
		   	<div class="input-group-btn">
		   	 	{!! Form::submit(trans('memo.add_memo'), ['class' => 'btn btn-primary']) !!}
		   	</div>
	   	</div>
	{!!  Form::close() !!}
@endsection

@section('footer_js')
	<script>
		var config = {
			routes: [{
				sort: '{{ route("sort.memos") }}',
				edit: '{{ route ("memo.update", "url_id") }}'
			}],
			others: [{
				csrf: "{{ csrf_token() }}",
				deletemsg: "{{ trans('global.deletemsg') }}"
			}]
		}
	</script>
	{!! Html::script('js/list_management_ajax.js'); !!}
@endsection
