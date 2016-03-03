
<div class="card">
    <header class="header">
        <a href="{{ action('StudyController@view', ['id' => $hit["_id"]]) }}">
            <strong class="label">{{ Utils::getEn($hit["_source"]["title"]) }}</strong>
        </a>
    </header>

    <div class="content">
        @if (array_key_exists("abstract", $hit["_source"]))
            <p>{{ str_limit(Utils::getEn($hit["_source"]["abstract"]), 150) }}</p>
        @endif
        @if(array_key_exists("highlight", $hit))
            @foreach($hit["highlight"] as $label => $highlight)
            <p>
                @foreach(array_keys($highlight) as $key)
                <strong>{{ $label }}</strong>: {!!$highlight[$key]!!}
                @endforeach
            </p>
            @endforeach
        @endif
        
    </div>
    <!-- /content -->
</div>
