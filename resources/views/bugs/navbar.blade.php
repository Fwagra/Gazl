<div class="navbar navbar-inverse">
	<div class="container-fluid">
		<a href="{{ action('BugController@index', [$project->slug, 'order' => 'time']) }}"
		 class="btn navbar-btn"
		 data-toggle="tooltip"
		 data-placement="bottom"
		 title="{{ trans('bug.order_time') }}">
		 	<i class="glyphicon glyphicon-time"></i>
		 </a>
		<a href="{{ action('BugController@index', [$project->slug, 'order' => 'state']) }}" 
		 class="btn navbar-btn"
		 data-toggle="tooltip"
		 data-placement="bottom"
		 title="{{ trans('bug.order_state') }}">
		<i class="glyphicon glyphicon-ok-circle"></i></a>
		<p class="navbar-text navbar-right">
			{!! Form::open(['action' => ['BugController@search', $project->slug], 'method' => 'POST', 'class' => "form-search"]) !!}
			    {!! Form::text('bug', '', ['id' =>  'bug-input', 'placeholder' =>  trans('bug.search_placeholder')])!!}
			    {{-- {!!  Form::token() !!} --}}
			    {!! Form::submit(trans('bug.search_button'), array('class' => 'button expand')) !!}
			    <div id="empty-message"></div>
			    {!! Form::button(trans('bug.reini_btn'), array('class' => 'reini-btn hide', "onclick" => "location.reload();")) !!}
			{!! Form::close() !!}
			@if (Auth::check())
				<div class="group">
					{!! Form::open(['route' => ['project.subscribe', $project->slug], 'method' =>'POST', 'class' => "auto-submit"]) !!}
						{!! Form::label('subscribe', trans('notification.notification_label'),  ['data-toggle' =>"tooltip", 'data-original-title' => trans('notification.subscription_tooltip'), 'data-placement' => 'right'])!!}
						{!! Form::checkbox('subscribe', 1, $notification) !!}
					{!! Form::close() !!}
				</div>
			@endif
			<a class="navbar-link" href="{{ action('BugController@create', $project->slug) }}">{{ trans('bug.add_bug') }}</a>
		</p>
	</div>
</div>