<div class="col-md-4 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ action('BugController@index', [$project->slug]) }}">
			{{ trans('bug.title_bug_dash') }}
			</a>
		</div>
    @if ($bugs['new'] != 0)
      <div class="new_bug">
    			{{ trans('bug.new_bugs_count', ['new' => $bugs['new']]) }}
      </div>
    @endif
    <div class="total_bugs">
      @if ($bugs['total'] == 0)
        {{ trans('bug.no_bugs') }}
      @else
        {{ trans('bug.bugs_count', ['total' => $bugs['total']]) }}
      @endif
    </div>
		<a href="{{ action('BugController@create', [$project->slug]) }}">
			{{ trans('bug.add_bug') }}
			</a>
	</div>
</div>
