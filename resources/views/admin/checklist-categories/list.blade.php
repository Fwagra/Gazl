@foreach($categories as $category)
<li class="list-group-item" data-id="{{ $category->id }}"><i class=" glyphicon glyphicon-th"></i> <span class="edit-element">{{ $category->name }}</span>
    {!! Form::open(['route' => ['admin.checklist-category.destroy', $category->id], 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
		<div class="form-group">
		    {!! Form::submit('×', ['class' => 'close'])!!}
		</div>
    {!!  Form::close() !!}
</li>
@endforeach