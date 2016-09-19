{!! csrf_field() !!}
<div class="form-group">
    {!! Form::label('name', trans('contacts.name'))!!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('contacts.name_placeholder')])!!}
</div>
<div class="form-group">
    {!! Form::label('email', trans('contacts.email'))!!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('contacts.email_placeholder')])!!}
</div>
<div class="form-group">
    {!! Form::label('phone', trans('contacts.phone'))!!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('contacts.phone_placeholder')])!!}
</div>
<div class="form-group">
    {!! Form::label('notes', trans('contacts.notes'))!!}
    {!! Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => trans('contacts.notes_placeholder')]) !!}
</div>
<div class="form-group">
    <div class="label">{!! trans('contacts.projects') !!}</div>
	@foreach ($projects as $project)
		<?php
			$status = (isset($linked_projects) && $linked_projects->contains($project->id)) ? true : false;
		?>
    	{!! Form::checkbox('projects['.$project->id.']', $project->id, $status, ['class' => 'form-control', 'id' => 'projects['.$project->id.']']) !!}
		{!! Form::label('projects['.$project->id.']', $project->name) !!}
	@endforeach
</div>
<div class="form-group">
    {!! Form::submit(trans('contacts.save'), ['class' => 'btn btn-primary'])!!}
</div>
