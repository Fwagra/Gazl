<ul class="list-group">
	@foreach ($bugs as $bug)
		<li class="list-group-item clearfix" data-id="{{ $bug->id }}">
			<div class="col-md-1 state">{{ $bug->state }}</div>
			<div class="col-md-10">
				<a href="{{ action('BugController@show', [$project->slug, $bug->id]) }}"> {{ $bug->name }}</a>
				@if ($bug->private == 1)
					<span class="private">{{ trans('bug.private_bug') }}</span>
				@endif
				<div class="bug_date">{{ trans('bug.reported_on') }} {{ $bug->created_at->format('d-m-Y') }}</div>
			</div>
			<div class="col-md-1">
			@if (Auth::check())
			    {!! Form::open(['action' => ['BugController@destroy', $project->slug, $bug->id]	, 'method' => 'DELETE', 'class' => 'delete-element']) !!}
					<div class="form-group">
					    {!! Form::submit('×', ['class' => 'close'])!!}
					</div>
			    {!!  Form::close() !!}
			@endif
				
			</div>
		</li>
	@endforeach
</ul>