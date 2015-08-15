{!! csrf_field() !!}
<div class="form-group">
    {!! Form::label('name', trans('access.name'), ['data-toggle' =>"tooltip", 'data-original-title' => trans('access.tooltip_title'), 'data-placement' => 'right'])!!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('access.name')])!!}
</div>
<div class="form-group">
    {!! Form::submit(trans('access.create'), ['class' => 'btn btn-primary'])!!}
</div>