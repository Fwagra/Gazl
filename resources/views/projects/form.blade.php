{!! csrf_field() !!}
<div class="form-group">
    {!! Form::label('name', trans('project.name'))!!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('project.name')])!!}
</div>
<div class="form-group">
    {!! Form::submit(trans('project.create'), ['class' => 'btn btn-primary'])!!}
</div>