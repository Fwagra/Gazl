{!! Form::open(array('route' => 'guest.login')) !!}
    {!! csrf_field() !!}
    <div class="form-group">
        {!! Form::label('public_id', trans('auth.public_id'))!!}
        {!! Form::text('public_id',null, ['class' => 'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::submit(trans('auth.submit'), ['class' => 'btn btn-primary'])!!}
    </div>
{!!  Form::close() !!}