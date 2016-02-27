{{ trans('bug.change_state') }}
@foreach ($states as $state)
	<?php $active = ($bug->state == $state)? 'active ' : ''; ?>
	<button data-state='{{ $state }}' class="{{ $active }}btn state-{{ $state }}">{{ trans('bug.state_'.$state) }}</button>
@endforeach