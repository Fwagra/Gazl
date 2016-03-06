@if (count($comments) > 0)
	<ul class="media-list">
		@foreach ($comments as $comment)
			<li class="media type-{{$comment->guest}}">
				<div class="media-body">
					<h4 class="media-heading">{{ $comment->name }}</h4>
					<p class="date">{{ $comment->created_at->format('d/m/Y - H:i:s') }}</p>
					<p class="comment-body">
						{!! nl2br(e($comment->comment)) !!}
					</p>		
				</div>
			</li>
		@endforeach
	</ul>
@else
	{{ trans('bug.no_comments_message') }}
@endif