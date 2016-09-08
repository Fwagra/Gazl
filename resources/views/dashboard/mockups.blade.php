@if(Auth::check())
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="{{ action('MockupController@index', [$project->slug]) }}">
				{{ trans('mockup.title_mockup_dash') }}
				</a>
			</div>
			<div class="panel-body">
				<div class="total">
					{!! trans_choice('mockup.total_dash', $mockups['total'], ['total' => $mockups['total']]) !!}
					@if (count($mockups['categories']))
						{!! trans_choice('mockup.total_cats_dash', $mockups['categories'], ['cats' => $mockups['categories']]) !!}
					@endif
				</div>
			</div>
			@if (Auth::check())
				<div class="panel-footer">
					<a href="{{ action('MockupController@create',[$project->slug]) }}">{!! trans('mockup.create_mockup') !!}</a>
				</div>
			@endif
		</div>
	</div>
@endif
