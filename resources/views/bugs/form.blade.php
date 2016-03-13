{!! csrf_field() !!}
<div class="form-group">
    {!! Form::label('name', trans('bug.name'))!!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('bug.name_placeholder')])!!}
</div>
<div class="form-group">
    {!! Form::label('url', trans('bug.url'))!!}
    {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => trans('bug.url_placeholder')])!!}
</div>
@if (!Auth::check())
	<div class="form-group">
	    {!! Form::label('author', trans('bug.author'))!!}
	    {!! Form::text('author', null, ['class' => 'form-control', 'placeholder' => trans('bug.author_placeholder')])!!}
	</div>
	<div class="form-group">
	    {!! Form::label('email', trans('bug.email'),  ['data-toggle' =>"tooltip", 'data-original-title' => trans('bug.email_tooltip'), 'data-placement' => 'right'])!!}
	    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('bug.email_placeholder')])!!}
	</div>
@else
	<div class="form-group">
	    {!! Form::label('private', trans('bug.private'),['data-toggle' =>"tooltip", 'data-original-title' => trans('bug.private_tooltip'), 'data-placement' => 'right'])!!}
	    <?php $check = (isset($bug) && $bug->private == 1)? true : null; ?>
	    {!! Form::checkbox('private', 1, $check, ['class' => 'form-control'])!!}
	</div>
@endif
@if (!isset($bug))
	<div class="form-group">
	    {!! Form::label('images', trans('bug.images'), ['data-toggle' =>"tooltip", 'data-original-title' => trans('bug.images_tooltip'), 'data-placement' => 'right'])!!}
	    {!! Form::file('images[]', ['multiple' => true])!!}
	</div>
@endif
<div class="form-group">
    {!! Form::label('description', trans('bug.description'))!!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('bug.description_placeholder')]) !!}
</div>
<div class="form-group">
    {!! Form::submit(trans('bug.save'), ['class' => 'btn btn-primary'])!!}
</div>