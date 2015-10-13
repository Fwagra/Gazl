{!! csrf_field() !!}
<div class="form-group">
    {!! Form::label('name', trans('project.name'))!!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('project.name')])!!}
</div>
<div class="form-group">
    {!! Form::label('cms', trans('project.cms'))!!}
    {!! Form::select('cms[]', $cms, $selected_cms, ['class' => 'form-control', 'placeholder' => '--', 'multiple']) !!}
</div>
<div class="form-group">
    {!! Form::submit(trans('project.save'), ['class' => 'btn btn-primary'])!!}
</div>