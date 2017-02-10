{!! Form::open(['action' => ['ProjectController@searchProject'], 'method' => 'GET', 'class' => "form-search"]) !!}
    {!! Form::text('project', '', ['id' =>  'project-autocomplete', 'placeholder' =>  trans('project.search_placeholder')])!!}
    {!! Form::submit(trans('project.search_button'), array('class' => 'button expand')) !!}
    <div id="empty-message"></div>
{!! Form::close() !!}

@section('footer_js')
	<script>
		var configAutocomplete = {
			urls: {
				source: "{!! route('project.search') !!}",
				redirect: "{!! route('project.index') !!}",
			},
			messages: [{
				noresult: "{!! trans('project.no_results_found') !!}",
			}],
		}
	</script>
@endsection
