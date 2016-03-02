@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="small-12 columns">
            <div class="row">
                <div class="small-6 columns">
                    <div class="searchbar">
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
                    </div>
                </div>
                <div class="small-6 columns">
                    {!! Form::submit("Search", array("class" => "button")) !!}
                    {!! Form::close() !!}
                </div>    
            </div> 
            <div class="row">
                <div class="small-12 columns">
                    <ul class="aggregations small-4 columns">
                    @foreach ($aggregations as $key => $aggregation)
                        @if (Input::has($key))
                            @foreach (Utils::getArgumentValues($key) as $value)
                                @if (Utils::keyValueActive($key, $value))
                                    <li class="aggregation">
                                        <a href="{{ route("search", Utils::removeKeyValue($key, $value)) }}" class="label label-info">
                                            <span class="text-info">{{ ucfirst($key) }}:</span> {{ $value }}
                                            <span class="badge">
                                                <i class="fi-x"></i>
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
            
            <h2>Filter Search Results by</h2>

            <ul class="small-block-grid-1 medium-block-grid-8">
                @foreach ($aggregations as $key => $aggregation)
                    @if (count($hits->aggregations[$key]["buckets"]) > 0 || Input::has($key))
                        <li class = "filter">
                            <h2>{{ $aggregations_title[$key] }}</h2>

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

            <p class="total"><strong>Total:</strong> <span>{{ $hits->total() }}</span></p>

            <ul class="small-block-grid-1 medium-block-grid-1">
                @foreach($hits as $hit)
                    @include("study._study")
                @endforeach
            </ul>
            <!-- /small-block-grid-1.medium-block-grid-3 -->

            {!! $hits->appends(Input::all())->render() !!}
        </div>
    </div>
@endsection
