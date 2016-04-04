@foreach($memos as $memo)
  <?php $check = ($memo->active == 0)? 0 : 1; ?>
<li class="list-group-item" data-id="{{ $memo->id }}"><i class=" glyphicon glyphicon-th"></i>
  {!! Form::open(['route' => ['memo.check', $memo->id], 'method' => 'POST', 'class' => 'check-element']) !!}
  {!! Form::checkbox('check', 1, $check) !!}
  {!! Form::close() !!}
  <span class="edit-element">{{ $memo->name }}</span>
    {!! Form::open(['route' => ['project.memo.destroy', $project->slug, $memo->id], 'method' => 'DELETE', 'class' => 'delete-element pull-right']) !!}
		<div class="form-group">
		    {!! Form::submit('×', ['class' => 'close'])!!}
		</div>
    {!!  Form::close() !!}
</li>
@endforeach
