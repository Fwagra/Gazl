@foreach ($categories as $category)
	<div class='sortable panel panel-default list-group'>
		<div class="panel-heading">
			{!! $category->name !!}
		</div>
		@foreach ($category->points()->orderBy('order')->get() as $point)
			<div class="list-group-item" data-point-id="{{ $point->id }}" data-category-id="{{ $category->id }}"><i class=" glyphicon glyphicon-th"></i> <span class="edit-element">{{ $point->name }}</span>
			</div>
		@endforeach
	</div>
@endforeach