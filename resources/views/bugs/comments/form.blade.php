<div class="comment-form">
	<h3>{{ trans('bug.add_comment_title') }}</h3>
	{!! Form::open(['url' => action('BugCommentController@store', [$project->slug, $bug->id])]) !!}
		@if (!Auth::check())
		    <div class="form-group">
		    	{!! Form::label('name', trans('bug.comment_name'))!!}
		    	{!! Form::text('name', null, ['class' => 'form-control'])!!}
		   	</div>
		@endif
	   	<div class="form-group">
	   		{!! Form::label('comment', trans('bug.comment_label')) !!}
	   		{!! Form::textarea('comment', null,['class' => 'form-control']) !!}
	   	</div>
	   	<div class="form-group">
	   	    {!! Form::submit(trans('bug.send_comment'), ['class' => 'btn btn-primary'])!!}
	   	</div>
	{!!  Form::close() !!}
</div>