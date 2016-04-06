<div class="col-md-4 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ action('MemoController@index', [$project->slug]) }}">
			{{ trans('memo.title_memo_dash') }}
			</a>
		</div>
    @if ($memos['total'] == 0)
      <div class="no_memos">
    			{{ trans('memo.no_memo_dash') }}
					<a href="{{ action('MemoController@index', [$project->slug]) }}">
					{{ trans('memo.link_add_memo_dash') }}
					</a>
      </div>
		@else
			<div class="memos">
				<div class="total">
					{!! trans('memo.dash_resume', ['total' => $memos['total'], 'active' => $memos['active']]) !!}
				</div>
				<div class="message">
					@if ($memos['total'] == $memos['active'])
						{!! trans('memo.all_active') !!}
					@else
						{!! trans('memo.memos_left', ['left' => $memos['left']]) !!}
					@endif
				</div>
			</div>
    @endif

	</div>
</div>
