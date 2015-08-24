<div class="container">
	<div class="clearfix">
		@if(Auth::check())
			<dl class="footer-nav">
				<dt class="nav-title">{{ trans('footer.management') }}</dt>
				<dd class="nav-item">
					<a href="{{ route('project.create') }}">{{ trans('footer.create_project') }}</a>
				</dd>
				@if(Cookie::get('key'))
				<dd class="nav-item">
					<a href="{{ route('key.set') }}">{{ trans('footer.edit_key') }}</a>
				</dd>
				@endif
			</dl>
			<dl class="footer-nav">
				@if(!File::exists(base_path('storage/.encryption_key')))
					<a href="{{ route('admin.key') }}" class="btn btn-danger btn-block">{{ trans('footer.set_global_key') }}</a>
				@elseif(Cookie::get('key') == null || !Hash::check(Cookie::get('key'), File::get(base_path('storage/.encryption_key'))))
					<a data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('footer.set_key_tooltip') }}" href="{{ route('key.set') }}" class="btn btn-warning btn-block">{{ trans('footer.set_key') }}</a>
				@endif
			</dl>
		@endif
	</div>
</div>