<li class="card">
    <header class="header">
        <span class="label">{{ $hit["_id"] }}</span>

        @if (array_key_exists("title", $hit["_source"]) && is_array($hit["_source"]["title"]))
            @foreach ($hit["_source"]["title"] as $title)
                @if (array_key_exists("en", $title))
                    <a href="/study/{{ $hit["_id"] }}">{{ $title["en"] }}</a>
                @endif
            @endforeach
        @else
            <a href="/study/{{ $hit["_id"] }}">[Title missing]</a>
        @endif
    </header>

    <div class="content">
        @if (array_key_exists("abstract", $hit["_source"]))
            @foreach ($hit["_source"]["abstract"] as $abstract)
                @if (array_key_exists("en", $abstract))
                    <p>{{ str_limit($abstract["en"], 290) }}</p>
                @endif
            @endforeach
        @endif
        @if(array_key_exists("highlight", $hit))
            @foreach($hit["highlight"] as $highlight)
                <p>
                @foreach(array_keys($highlight) as $key)
                        {!!$highlight[$key]!!}
                @endforeach
                </p>
            @endforeach
        @endif
    </div>
    <!-- /content -->
</li>
