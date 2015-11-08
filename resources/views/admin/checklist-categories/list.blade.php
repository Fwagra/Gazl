@foreach($categories as $category)
<li class="list-group-item" data-id="{{ $category->id }}"><i class=" glyphicon glyphicon-th"></i> {{ $category->name }}
	{{-- <button type="button" class="close pull-right" data-dismiss="alert" aria-hidden="true">×</button> --}}
    {!! Form::open(['route' => ['admin.checklist-category.destroy', $category->id], 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
		<div class="form-group">
		    {!! Form::submit('×', ['class' => 'close'])!!}
		</div>
    {!!  Form::close() !!}
</li>
@endforeach