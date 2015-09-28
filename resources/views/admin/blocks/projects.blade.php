<div class="col-md-4 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans('admin.projects') }}</div>
		<div class="list-group">
			<a href="#" class="list-group-item">
				{{ trans('admin.all_projects') }}
			</a>
			<a href="{{ action('ProjectController@create') }}" class="list-group-item">
			{{ trans('admin.create_project') }}
			</a>
		</div>
	</div>
</div>