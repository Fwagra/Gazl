@if (count($comments) > 0)
	@foreach ($comments as $comment)
		
	@endforeach
@else
	{{ trans('bug.no_comments_message') }}
@endif