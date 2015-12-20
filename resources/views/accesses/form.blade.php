{!! csrf_field() !!}
<div class="form-group">
    {!! Form::label('name', trans('access.name'), 
        ['data-toggle' =>"tooltip", 'data-original-title' => trans('access.tooltip_title'), 'data-placement' => 'right']
    )!!}
    {!! Form::text('name', null, 
        ['class' => 'form-control', 'placeholder' => trans('access.name')]
    )!!}
</div>
<div class="form-group">
    {!! Form::label('name', trans('access.category'))!!}
    {!! Form::select('access_category_id', $categories, $selected_category, 
        ['class' => 'form-control', 'placeholder' => '--']
    ) !!}
</div>
<div class="form-group">
	{!! Form::label('host', trans('access.host'), 
		['data-toggle' => "tooltip", 'data-original-title' => trans('access.tooltip_host'), 'data-placement' => 'right']
	)!!}
	{!! Form::text('host', null, 
		['class' => 'form-control', 'placeholder' => trans('access.host')]
	)!!}
</div>
<div class="form-group">
	{!! Form::label('login', trans('access.login'), 
		['data-toggle' => "tooltip", 'data-original-title' => trans('access.tooltip_login'), 'data-placement' => 'right']
	)!!}
	{!! Form::text('login', null, 
		['class' => 'form-control', 'placeholder' => trans('access.login')]
	)!!}
</div>
<div class="form-group">
	{!! Form::label('password', trans('access.password'), 
		['data-toggle' => "tooltip", 'data-original-title' => trans('access.tooltip_password'), 'data-placement' => 'right']
	)!!}
	{!! Form::text('password', null, 
		['class' => 'form-control', 'placeholder' => trans('access.password')]
	)!!}
</div>
<div class="form-group">
    {!! Form::submit(trans('access.create'), ['class' => 'btn btn-primary'])!!}
</div>