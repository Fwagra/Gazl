{!! Form::open(array('route' => 'post.login')) !!}
    {!! csrf_field() !!}
    <div class="form-group">
        {!! Form::label('email', trans('auth.email'))!!}
        {!! Form::email('email',  old('email'), ['class' => 'form-control', 'placeholder' => trans('auth.email')])!!}
    </div>
    <div class="form-group">
        {!! Form::label('password', trans('auth.password'))!!}
        {!! Form::password('password',['class' => 'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('remember', trans('auth.remember')) !!} {!! Form::checkbox('remember', null) !!}
    </div>
    <div class="form-group">
        {!! Form::submit(trans('auth.submit'), ['class' => 'btn btn-primary'])!!}
    </div>
{!!  Form::close() !!}