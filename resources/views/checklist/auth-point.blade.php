<div class="list-group-item">
	{!! Form::open(['route' => ['project.checklist.update',$project->slug, $point->id], 'method' => 'PUT', 'class' => 'checklist-form']) !!}
		<div class="checkbox">
			{!! Form::checkbox('check', 1, $check) !!}
		</div>
		<div class="checklist-point">
			<div class="name">{{ $point->name }}</div>
			<div class="description">{{ $point->description }}</div>
			<div class="comments {{ $commentClass }}">
				{!! Form::textarea('comment', $comment) !!}
			</div>
		</div>
		<div class="activation">
			{!! Form::checkbox('active', 1, $active) !!}
		</div>
	{!! Form::close() !!}
</div>
