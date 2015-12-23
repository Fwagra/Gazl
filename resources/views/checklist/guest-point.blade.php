<div class="list-group-item">
	<div class="checkbox">
		{!! Form::checkbox('check', 1, $check, ['disabled']) !!}
	</div>
	<div class="checklist-point">
		<div class="name">{{ $point->name }}</div>
		<div class="description">{{ $point->description }}</div>
		<div class="comments">
			@if ($comment)
				{{ $comment }}
			@endif
		</div>
	</div>
</div>