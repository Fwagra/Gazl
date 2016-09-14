@if (Auth::check() OR (!Auth::check() AND $doc != null))
<div class="col-md-4 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ action('InternalDocumentationController@index', [$project->slug]) }}">
                {{ trans('internaldoc.dashboard_title') }}
            </a>
        </div>

        @if(Auth::check())
        <a href="{{ action('InternalDocumentationController@edit', [$project->slug]) }}">
            @if (!$doc)
                {!! trans('doc.write_doc') !!}
            @else
                {{ trans('doc.edit_doc') }}
            @endif
        </a>
        @endif

        @if($doc)
        <a href="{{ action('InternalDocumentationController@index', [$project->slug]) }}">
            {{ trans('doc.view_doc') }}
        </a>
        @endif

    </div>
</div>
@endif
