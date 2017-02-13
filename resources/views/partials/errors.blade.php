@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
@if(Session::has('message'))
    <div class="alert alert-success">
        {{  Session::get('message') }}
    </div>
@endif
