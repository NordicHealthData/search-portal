@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="small-12 columns">
            <h1>Search Health Data</h1>

            {!! Form::open(array("action" => "SearchController@search", "method" => "GET")) !!}
            {!! Form::text("q", Request::input("q"), array("class" => "search", "autocomplete" => "off", "placeholder" => "Search for Studies...", "data-suggesturl"=> action("SearchController@suggest"))) !!}

            @if (isset($hits->aggregations))
                @foreach ($hits->aggregations as $key => $aggregation)
                    @if (Input::get($key))
                        {!! Form::hidden($key, Input::get($key)) !!}
                    @endif
                @endforeach
            @endif

            {!! Form::submit("Search", array("class" => "button")) !!}
            {!! Form::close() !!}

            @foreach ($aggregations as $key => $aggregation)
                @if (Input::has($key))
                    @foreach (Utils::getArgumentValues($key) as $value)
                        @if (Utils::keyValueActive($key, $value))
                            <a href="{{ route("search", Utils::removeKeyValue($key, $value)) }}" class="label label-info">
                                <span class="text-info">{{ ucfirst($key) }}:</span> {{ $value }}
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <h2>Filter Search Results by</h2>

            <ul class="small-block-grid-1 medium-block-grid-4">
                @foreach ($aggregations as $key => $aggregation)
                    @if (count($hits->aggregations[$key]["buckets"]) > 0 || Input::has($key))
                        <li class = "filter">
                            <h2>{{ ucfirst($key) }}</h2>

                            <ul class="filters">
                                @if (Input::has($key))
                                    @foreach (Utils::getArgumentValues($key) as $value)
                                        @if (Utils::keyValueActive($key, $value))
                                            <li>
                                                <a href="{{ route("search", Utils::removeKeyValue($key, $value)) }}" class="active">
                                                    <span class="label">X</span>
                                                    {{ $value }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                                @foreach ($hits->aggregations[$key]["buckets"] as $bucket)
                                    @if (Utils::keyValueActive($key, $bucket["key"]) == false)
                                        <li>
                                            <a href="{{ route("search", Utils::addKeyValue($key, $bucket["key"])) }}">
                                                <span class="label">{{ $bucket["doc_count"] }}</span>
                                                {{ $bucket["key"] }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <!-- /filters -->
                        </li>
                    @endif
                @endforeach
            </ul>

            <p><strong>Total:</strong> <span class="badge">{{ $hits->total() }}</span></p>

            <ul class="small-block-grid-1 medium-block-grid-3">
                @foreach($hits as $hit)
                    @include("study._study")
                @endforeach
            </ul>
            <!-- /small-block-grid-1.medium-block-grid-3 -->

            {!! $hits->appends(Input::all())->render() !!}
        </div>
    </div>
@endsection
