@if(Auth::check() && count($accesses))
	<div class="col-md-4 col-xs-12">
		<div class="panel-group panel-group-lists collapse in" id="accordion2">
			@foreach($accesses as $key => $access)
				  <div class="panel">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				      	<a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse-{{ $key }}">
				      	  {{ $access->name }}
				      	</a>
				      </h4>
				    </div>
				    <div id="collapse-{{ $key }}" class="panel-collapse collapse">
				      <div class="panel-body">
				        <div class="group">
				        	<strong>{{ trans('access.host') }} : </strong><span class="val">{{ $access->host }}</span>
				        </div>
				        <div class="group">
				        	<strong>{{ trans('access.login') }} : </strong><span class="val">{{ $access->login }}</span>
				        </div>
				        <div class="group">
				        	<strong>{{ trans('access.password') }} : </strong><span class="val">{{ $access->password }}</span>
				        </div>
				        <div class="group">
				        	<div class="text-right"><a href="{{ action('AccessesController@edit', [$project->slug, $access->id]) }}">{{ trans('access.edit') }}</a></div>
				        </div>
				      </div>
				    </div>
				  </div>
			@endforeach
		</div>
	</div>
@endif
