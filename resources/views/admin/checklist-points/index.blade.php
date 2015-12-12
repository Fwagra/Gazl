@extends('app')
@section('title', trans('checklist.list_points'))
@section('content')
    <h1>{{ trans('checklist.list_points') }}</h1>
    @if ($categories)
            @include('admin.checklist-points.list')  
    @endif
@endsection

@section('footer_js')
	<script>
		var config = {
			routes: [{ 
				sort: '{{ route("sort.checklist") }}',
				edit: '{{ route ("admin.checklist-category.update", "url_id") }}'
			}],
			others: [{
				csrf: "{{ csrf_token() }}",
				deletemsg: "{{ trans('global.deletemsg') }}"
			}]
		}
	</script>
	{!! Html::script('js/list_management_ajax.js'); !!}
@endsection