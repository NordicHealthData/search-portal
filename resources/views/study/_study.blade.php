
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
            <p>
            @foreach($hit["highlight"] as $label => $highlight)
                @foreach(array_keys($highlight) as $key)
                <strong>{{ explode(".", $label)[0] }}</strong>: {!!$highlight[$key]!!}
                @endforeach
            @endforeach
            </p>
        @endif
        
    </div>
    <!-- /content -->
</div>
