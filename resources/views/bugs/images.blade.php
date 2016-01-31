@if ($bug && !empty($bug->images))
	<?php $images = unserialize($bug->images) ?>
	<ul>
	@foreach ($images as $image)
		<li><a href="/uploads/screenshots/{{ $image }}"><img src="/uploads/screenshots/thumbnails/{{ $image}}" /></a></li>
	@endforeach
	</ul>
@else
	{{ trans('bug.no_screen') }}
@endif