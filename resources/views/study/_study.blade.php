<li class="card">
    <header class="header">
        <span class="label">{{ $hit["_id"] }}</span>
        <a href="/study/{{ $hit["_id"] }}">{{ Utils::getEn($hit["_source"]["title"]) }}</a>
    </header>

    <div class="content">
        @if(array_key_exists("highlight", $hit))
            @foreach($hit["highlight"] as $highlight)
                <p>
                @foreach(array_keys($highlight) as $key)
                        {!!$highlight[$key]!!}
                @endforeach
                </p>
            @endforeach
        @elseif (array_key_exists("abstract", $hit["_source"]))
            {{ str_limit(Utils::getEn($hit["_source"]["abstract"]), 150) }}
        @endif
    </div>
    <!-- /content -->
</li>
