{{ trans('bug.change_state') }}
@foreach ($states as $state)
	<button data-state='{{ $state }}' class="btn">{{ trans('bug.state_'.$state) }}</button>
@endforeach