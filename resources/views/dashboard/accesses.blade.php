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
				        	<span class="bold">{{ trans('access.host') }} : </span><span class="val">{{ $access->host }}</span>
				        </div>
				        <div class="group">
				        	<span class="bold">{{ trans('access.login') }} : </span><span class="val">{{ $access->login }}</span>
				        </div>
				        <div class="group">
				        	<span class="bold">{{ trans('access.password') }} : </span><span class="val">{{ $access->password }}</span>
				        </div>
				      </div>
				    </div>
				  </div>
			@endforeach
		</div>
	</div>
@endif
