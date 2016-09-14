@extends('app')
@section('title', trans('internaldoc.doc_title'))
@section('content')
	<h1>{!! trans('internaldoc.doc_h1') !!}</h1> @if (Auth::check())
		<a class="btn btn-success" href="{{ action('InternalDocumentationController@edit', [$project->slug]) }}">{!! trans('doc.link_to_edit') !!}</a>
	@endif
  <div id="toc"></div>
  <div id="documentation">
    {!! $doc->html_value !!}
  </div>

  <script type="text/javascript">
	  jQuery('document').ready(function(){
	    jQuery('#toc').toc({
	      'selectors' : 'h2, h3, h4'
	    });
	  });
  </script>

@endsection
@section('footer_js')
  {!! Html::script('js/toc.min.js'); !!}
@endsection
