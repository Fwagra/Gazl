<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/bootflat.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/flat/red.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}">
    </head>
    <body>
        <div class="mockup-container">
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
            @yield('content')
        </div>
    </body>
    @yield('footer_js')
</html>
