@foreach ($categories as $category)
	<div class='sortable panel panel-default list-group' data-category-id="{{ $category->id }}">
		<div class="panel-heading">
			{!! $category->name !!}
		</div>
		@foreach ($category->points()->orderBy('order')->get() as $point)
			<div class="list-group-item" data-id="{{ $point->id }}"><i class=" glyphicon glyphicon-th"></i> <a href="{{ route('admin.checklist-point.edit', $point->id) }}">{{ $point->name }}</a>
			    {!! Form::open(['route' => ['admin.checklist-point.destroy', $point->id], 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
					<div class="form-group">
					    {!! Form::submit('×', ['class' => 'close'])!!}
					</div>
			    {!!  Form::close() !!}
			</div>
		@endforeach
	</div>
@endforeach