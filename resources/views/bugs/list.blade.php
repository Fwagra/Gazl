<ul class="list-group">
	@foreach ($bugs as $bug)
		<li class="list-group-item clearfix">
			<div class="col-md-1 state">{{ $bug->state }}</div>
			<div class="col-md-10">
				<a href="{{ action('BugController@show', [$project->slug, $bug->id]) }}"> {{ $bug->name }}</a>
				@if ($bug->private == 1)
					<span class="private">{{ trans('bug.private_bug') }}</span>
				@endif
				<div class="bug_date">{{ trans('bug.reported_on') }} {{ $bug->created_at->format('d-m-Y') }}</div>
			</div>
			<div class="col-md-1">{{ trans('bug.delete') }}</div>
		</li>
	@endforeach
</ul>