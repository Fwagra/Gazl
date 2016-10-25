@if (Auth::check())
<div class="col-md-4 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ action('InternalDocumentationController@index', [$project->slug]) }}">
                {{ trans('internaldoc.dashboard_title') }}
            </a>
        </div>

        <a href="{{ action('InternalDocumentationController@edit', [$project->slug]) }}">
            @if (!$internaldoc)
                {!! trans('doc.write_doc') !!}
            @else
                {{ trans('doc.edit_doc') }}
            @endif
        </a>

        @if($internaldoc)
        <a href="{{ action('InternalDocumentationController@index', [$project->slug]) }}">
            {{ trans('doc.view_doc') }}
        </a>
        @endif

    </div>
</div>
@endif
