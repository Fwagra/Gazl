<div class="col-md-4 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans('admin.keys_management') }}</div>
		<div class="list-group">
			<a href="{{ route('admin.key') }}" class="list-group-item">
				{{ trans('admin.edit_global_key') }}
			</a>
			<a href="{{ route('key.set') }}" class="list-group-item">
			{{ trans('admin.edit_my_key') }}
			</a>
		</div>
	</div>
</div>