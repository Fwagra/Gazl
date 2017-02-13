<!DOCTYPE html>
<html>
    @include('partials.head')
    <body>
        <div class="mockup-container">
            @include('partials.errors')
            @yield('content')
        </div>
    </body>
    @include('partials.footer_js')
    @yield('footer_js')
</html>
