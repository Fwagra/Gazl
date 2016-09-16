@if(Auth::check())
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="{{ action('ContactController@index', [$project->slug]) }}">
					{{ trans('contacts.dash_block_title') }}
				</a>
			</div>
			<div class="panel-body">
				<ul class="contacts-starred">
					@if (count($contacts))
						@foreach ($contacts as $contact)
							<li>
								<a href="{{ action('ContactController@show',[$project->slug, $contact->id]) }}">
									{!! $contact->name !!}
								</a>
							</li>
						@endforeach
					@endif
				</ul>
			</div>
			<div class="panel-footer">
				<a href="{{ action('ContactController@create',[$project->slug]) }}">{!! trans('contacts.new_contact_action') !!}</a>
			</div>
		</div>
	</div>
@endif
