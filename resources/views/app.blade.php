<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - @yield('title')</title>
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/bootflat.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}">
    </head>
    <body>
        <div class="navbar navbar-default">dsd</div>
        <div class="container">
           @yield('content')
        </div>
    </body>
</html>
