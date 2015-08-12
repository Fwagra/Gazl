@if(Auth::check())
	<a href="{{ url('auth/logout') }}">{{ trans('auth.logout') }}</a>
@endif
@if(Cookie::get('public_id'))
	<a href="{{ route('guest.logout') }}">{{ trans('auth.logout') }}</a>
@endif