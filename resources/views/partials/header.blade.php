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
