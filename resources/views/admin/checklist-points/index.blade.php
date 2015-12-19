@extends('app')
@section('title', trans('checklist.list_points'))
@section('content')
    <h1>{{ trans('checklist.list_points') }}</h1>
    <div class="list-points">
        @if ($categories)
                @include('admin.checklist-points.list')
        @else
            {{ trans('checklist.no-category') }}
        @endif
    </div>
    {!! Form::open(['route' => 'admin.checklist-point.store', 'id' => 'add_category', 'class' => 'add_element']) !!}
    	@include('admin.checklist-points.form')
    {!!  Form::close() !!}
@endsection

@section('footer_js')
	<script>
		var config = {
			routes: [{ 
				sort: '{{ route("sort.checklist") }}',
			}],
			others: [{
				csrf: "{{ csrf_token() }}",
				deletemsg: "{{ trans('global.deletemsg') }}"
			}]
		}
	</script>
	{!! Html::script('js/list_management_ajax.js'); !!}
@endsection