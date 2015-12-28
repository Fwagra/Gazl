<div class="col-md-4 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ action('ChecklistAnswerController@index', [$project->slug]) }}">
			{{ trans('checklist.title_checklist') }}
			</a>
		</div>
		@if ($answers['checked'] == 0)
			{{ trans('checklist.no_check') }}
		@elseif ($answers['checked'] == $answers['total'])
			{{ trans('checklist.validated', ['checked' => $answers['checked'], 'total' => $answers['total']]) }}
		@else
			{{ trans('checklist.validation_status', ['checked' => $answers['checked'], 'total' => $answers['total']]) }}
		@endif

		<a href="{{ action('ChecklistAnswerController@index', [$project->slug]) }}">
			{{ trans('checklist.goto_checklist') }}
			</a>
	</div>
</div>
