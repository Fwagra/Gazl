@foreach($memos as $memo)
<li class="list-group-item" data-id="{{ $memo->id }}"><i class=" glyphicon glyphicon-th"></i> <span class="edit-element">{{ $memo->name }}</span>
    {!! Form::open(['route' => ['project.memo.destroy', $project->slug, $memo->id], 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
		<div class="form-group">
		    {!! Form::submit('×', ['class' => 'close'])!!}
		</div>
    {!!  Form::close() !!}
</li>
@endforeach
