<div class="container">
	<div class="clearfix">
		@if(Auth::check()){
			<dl class="footer-nav">
				<dt class="nav-title">{{ trans('footer.management') }}</dt>
				<dl class="nav-item">
					<a href="{{ route('project.create') }}">{{ trans('footer.create_project') }}</a>
				</dl>
			</dl>
			<dl class="footer-nav">
				@if(!File::exists(base_path('storage/.encryption_key')))
					<a href="{{ route('admin.key') }}" class="btn btn-danger btn-block">{{ trans('footer.set_global_key') }}</a>
				@endif
			</dl>
		@endif
	</div>
</div>