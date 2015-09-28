<div class="col-md-4 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans('admin.checklist_management') }}</div>
		<div class="list-group">
			<a href="{{ action('ChecklistCategoryController@index') }} " class="list-group-item">
				{{ trans('admin.categories_list') }}
			</a>
			<a href="{{ action('ChecklistCategoryController@create') }}" class="list-group-item">
			{{ trans('admin.categories_create') }}
			</a>
		</div>
	</div>
</div>