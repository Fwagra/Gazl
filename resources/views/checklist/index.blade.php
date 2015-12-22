@extends('app')
@section('title', trans('checklist.title_checklist'))
@section('content')
<h1>{{ trans('checklist.title_checklist') }}</h1>
	@foreach ($categories as $category)
		<div class='panel panel-default list-group'>
			<div class="panel-heading">
				{!! $category->name !!}
			</div>
			@foreach ($category->points()->orderBy('order')->get() as $point)
				<div class="list-group-item">
					{!! Form::open(['route' => ['project.checklist.update',$project->slug, $point->id], 'method' => 'PUT', 'class' => '']) !!}
						<div class="checkbox">
							{!! Form::checkbox('check', 1, true) !!}
						</div>
						{{ $point->name }}
					{!! Form::close() !!}
				</div>
			@endforeach
		</div>
	@endforeach
@endsection