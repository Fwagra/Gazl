<!DOCTYPE html>
<html>
    @include('partials.head')
    <body>
        @include('partials.header')
        <div class="container">
            @include('partials.errors')
            @yield('content')
        </div>
        <footer class="footer">
            @include('footer')
        </footer>
    </body>
    @include('partials.footer_js')
    @yield('footer_js')
</html>
