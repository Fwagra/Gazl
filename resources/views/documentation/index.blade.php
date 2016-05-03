@extends('app')
@section('title', trans('doc.doc_title'))
@section('content')
	<h1>{!! trans('doc.doc_h1') !!}</h1> @if (Auth::check())
		<a class="btn btn-success" href="{{ action('DocumentationController@edit', [$project->slug]) }}">{!! trans('doc.link_to_edit') !!}</a>
	@endif
	<a href="{{ action('DocumentationController@generatePdf',[$project->slug]) }}" class="btn btn-success">{!! trans('doc.download_pdf') !!}</a>
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
