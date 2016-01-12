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
			<a class="navbar-link" href="{{ action('BugController@create', $project->slug) }}">{{ trans('bug.add_bug') }}</a>
		</p>
	</div>
</div>