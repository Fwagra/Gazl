<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/bootflat.min.css')}}">
    </head>
    <body>
        <div class="container">
           @yield('content')
        </div>
    </body>
</html>
