
    <li class="card">
        <header class="header">
            <a href="{{ action('StudyController@view', ['id' => $hit["_id"]]) }}">
                <strong class="label">{{ $hit["_id"] }}</strong>
                {{ Utils::getEn($hit["_source"]["title"]) }}
            </a>
        </header>

        <div class="content">
            @if(array_key_exists("highlight", $hit))
                @foreach($hit["highlight"] as $label => $highlight)
                    <p>
                    @foreach(array_keys($highlight) as $key)
                        <strong>{{ $label }}</strong>: {!!$highlight[$key]!!}
                    @endforeach
                    </p>
                @endforeach
            @elseif (array_key_exists("abstract", $hit["_source"]))
                {{ str_limit(Utils::getEn($hit["_source"]["abstract"]), 150) }}
            @endif
        </div>
        <!-- /content -->
    </li>
