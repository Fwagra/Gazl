@if(isset($projectPID))
    <span class="label float label-primary" data-toggle="modal" data-target="#code-project-popup">{{ $projectPID }}</span>
@endif
@section('footer_js')
    @if (isset($project))
    <div class="modal fade" id="code-project-popup" tabindex="-1" role="dialog" aria-labelledby="titrePopUp" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">{!! trans('project.popup_code_title') !!}
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> </h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['project.sendcode', $project->slug], 'method' => 'POST', 'class' => "form-send-code", 'data-toggle' => 'validator']) !!}
                    {!! Form::label(trans('project.email_field')) !!}
                    {!! Form::email('email', '', ['class' => 'form-control', 'data-error' => 'test', 'required' => 'required'])!!}
                    {!! Form::submit(trans('project.send_code_button'), array('class' => 'button expand')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
