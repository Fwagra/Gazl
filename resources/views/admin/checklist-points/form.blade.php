{!! csrf_field() !!}
<div class="errors"></div>
<div class="input-group">
    {!!  Form::text('name', null, ['class' => 'form-control','id' => 'name', 'placeholder' => trans('checklist.new_point')]) !!}
</div>
<div class="input-group">
	{!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => trans('checklist.description')]); !!}
</div>
<div class="input-group">
	{!! Form::select('checklist_category_id', $categoriesSelect); !!}
</div>
<div class="input-group-btn">
    {!! Form::submit(trans('checklist.add_point'), ['class' => 'btn btn-primary']) !!}
</div>
