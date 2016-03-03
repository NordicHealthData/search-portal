@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="small-4 columns">
            <div class="row">
                <div class="searchbar small-12 columns">
                    <div class="small-10 columns">
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
                    <div class="small-2 columns">
                        <button type="submit" class="button">
                                <i class="fi-magnifying-glass"></i>
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="small-12 columns">
                                            <ul class="aggregations">
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
            


            <p><strong>Filter search result by</strong></p>

            <ul class="filters">
                @foreach ($aggregations as $key => $aggregation)
                    @if (count($hits->aggregations[$key]["buckets"]) > 0 || Input::has($key))
                        <strong>{{ $aggregations_title[$key] }}</strong>

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
                        <br>
                        <!-- /filters -->
                    @endif
                @endforeach
            </ul>


        </div>

        <div class="medium-8 columns">
            
            <p>
                Your search returned a total number of <strong>{{ $hits->total() }} studies.</strong>
            </p>

            
            @foreach($hits as $hit)
                @include("study._study")
            @endforeach
           

            {!! $hits->appends(Input::all())->render() !!}

        </div>

    </div>
@endsection
