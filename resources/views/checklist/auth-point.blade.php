{!! Form::open(['route' => ['project.checklist.update',$project->slug, $point->id], 'method' => 'PUT', 'class' => '']) !!}
	<div class="checkbox">
		{!! Form::checkbox('check', 1, $check) !!}
	</div>
	<div class="checklist-point">
		{{ $point->name }}
	</div>
	<div class="activation">
		{!! Form::checkbox('active', 1, $active) !!}
	</div>
	<div class="comments {{ $commentClass }}">
		{!! Form::textarea('comment', $comment) !!}
	</div>
{!! Form::close() !!}