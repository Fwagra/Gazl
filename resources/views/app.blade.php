<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    </head>
    <body>
        <div class="navbar main-nav">
           <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('home') }}">Dashboard</a>
                    @if (isset($projectPID))
                        <a href="{{ action('ProjectController@show', $project->slug)}}">{{ $project->name }}</a>
                    @endif
                </div>
                <div class="navbar-text navbar-right">
                    @yield('info_head')
                    @include('projects.info')
                    @include('auth.login-zone')
                </div>
           </div>
        </div>
        <div class="container">
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
        <footer class="footer">
            @include('footer')
        </footer>
    </body>
    @yield('footer_js')
    <script>

    var config = {
        messages: {
            deletemsg: "{{ trans('global.deletemsg') }}"
        }
    }

    </script>
    <script src="{{ URL::asset('js/app.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function(){
          $('input').not('.no-icheck').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
          });
          $('[data-toggle="tooltip"]').tooltip();
        });
        $(document).ajaxComplete(function(){
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
          });
        });
    </script>
</html>
