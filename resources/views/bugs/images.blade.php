@if ($bug && !empty($bug->images))
	<?php $images = unserialize($bug->images) ?>
	<ul>
	@foreach ($images as $key => $image)
		<li data-id="{{ $key }}"><a href="/uploads/screenshots/{{ $image }}"><img src="/uploads/screenshots/thumbnails/{{ $image}}" /></a>
		    {!! Form::open(['route' => ['bug.image.delete', $project->slug, $bug->id ], 'method' => 'GET', 'class' => 'delete-element']) !!}
		    	{!! Form::token() !!}
		    	{!! Form::hidden('image_name', $image) !!}
				<div class="form-group">
				    {!! Form::submit('×', ['class' => 'close'])!!}
				</div>
		    {!!  Form::close() !!}
		</li>
	@endforeach
	</ul>
@else
	{{ trans('bug.no_screen') }}
@endif