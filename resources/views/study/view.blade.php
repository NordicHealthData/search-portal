@extends("layouts.default")

@section("content")

<div id="study" class="row">

    <div class="small-12 columns">
        <h1 class="title" >{{ Utils::getEn($study["_source"]["title"]) }}</h1>
    </div>

    <div class="medium-8 columns">

            @if (array_key_exists("creator", $study["_source"]))
            <p>
                <strong>Principal investigator</strong>

            <ul>
                @foreach ($study["_source"]["creator"] as $creator)
                    @if(array_key_existst("en", $study["_source"]["creator"]) && is_array($study["_source"]["creator"]["en"]))
                        @if (array_key_exists("en", $creator))
                        <li>{{ $creator["en"] }}</li>
                        @endif
                        @if (array_key_exists("undefLang", $creator))
                        <li>{{ $creator["undefLang"] }}</li>
                        @endif
                    @else
                        <li>{{ $creator }}</li>
                    @endif
                @endforeach
            </ul>
            </p>
            @endif

            <p>
                @if (array_key_exists("startdate", $study["_source"]))
                  <strong>Data collection start date:</strong> <span>{{ $study["_source"]["startdate"] }}</span><br />
                @endif

                @if (array_key_exists("enddate", $study["_source"]))
                  <strong>Data collection end date:</strong>

                  @if ($study["_source"]['enddate']=='')
                     <span>Still ongoing</span>
                  @else
                    <span>{{ $study["_source"]["enddate"] }}</span>
                  @endif
                @else
                <strong>Data collection end date:</strong> <span>Still ongoing</span>
                @endif
            </p>

            <p>
            <strong>Archive identifier: </strong><span>{{ $study["_id"] }}</span>
            </p>

            @if (array_key_exists("doi", $study["_source"]))
            <p>
            <strong>DOI:</strong> <span>{{ $study["_source"]["doi"] }}</span>
            </p>
            @endif

            @if (array_key_exists("timemethod", $study["_source"]))
            <p>
                <strong>Study design:</strong>
                <ul>
                    @foreach ($study["_source"]["timemethod"] as $timemethod)
                    @if (array_key_exists("en", $timemethod))
                    <li>{{ Utils::getEn($study["_source"]["timemethod"]) }}</li>
                    @endif
                    @endforeach
                </ul>
            </p>
            @endif

            @if (array_key_exists("analysisunit", $study["_source"]))
            <p>
            <strong>Unit of analysis:</strong> <span>{{ $study["_source"]["analysisunit"] }}</span>
            </p>
            @endif

            @if (isset($study["_source"]["kindofdata"]))
            <p>
                <strong>Kind of data:</strong>

                @if(is_array($study["_source"]["kindofdata"]))
                    <ul>
                    @foreach ($study["_source"]["kindofdata"] as $kindofdata)
                        <li>{{ $kindofdata }}</li>
                    @endforeach
                    </ul>
                @else
                    {{ $study["_source"]["kindofdata"] }}
                @endif
            </p>
            @endif

            @if (array_key_exists("modeofcollection", $study["_source"]))
            <p>
                <strong>Data collection method:</strong>
                <span>{{ Utils::getEn($study["_source"]["modeofcollection"]) }}</span>
            </p>
            @endif

            @if (isset($study["_source"]["country"]) && count($study["_source"]["country"]) > 0)
            <p>
                <strong>Geographic coverage:</strong> <span>{{ $study["_source"]["country"] }}</span>
            </p>
            @endif

            @if (isset($study["_source"]["universe"]))
                <strong>Universe</strong>
                <ul>
                    @foreach ($study["_source"]["universe"] as $universe)
                        @if (count($universe) > 0)
                            <li>{{ Utils::getEn($universe) }}</li>
                        @endif
                    @endforeach
                </ul>
            @endif

            @if (array_key_exists("abstract", $study["_source"]))
            <p class="abstract" >
                <strong>Abstract:</strong>
                <br>
                {{ Utils::getEn($study["_source"]["abstract"]) }}
            </p>

            @endif

            @if (array_key_exists("purpose", $study["_source"]))
            <p class="purpose">
                <strong>Purpose</strong>
                {{ Utils::getEn($study["_source"]["purpose"]) }}</p>
            </p>
            @endif

    </div>
    <div  class="medium-4 columns">

        @if ($study["_source"]["landingpage"])
        <p>
            <a class="landingpage" href="{{ $study["_source"]["landingpage"] }}" title="If you have any questions regarding this data set please refer your questions to the archive responsible for the study.">
                <i class="fi-web"></i>
                Access resource at host archive
            </a>
        </p>
        @endif

        @if (count($study['related'] < 0))
        <div>
            <strong>Related studies</strong>
            <p>
                @foreach ($study["related"] as $related)
                <span class="sidebar-item">
                    <i class="fi-page-filled"></i><a href="{{ action('StudyController@view', ['id' => $related["_id"]]) }}">{{ Utils::getEn($related["_source"]["title"]) }}</a>
                </span>
                <br/>
                @endforeach
            </p>
        </div>
        @endif

        @if (array_key_exists("subject", $study["_source"]))
        <div>
            <strong>Subjects</strong>

            <p>
                @foreach ($study["_source"]["subject"] as $subject)
                @if (is_array($subject) && array_key_exists("en", $subject) && !is_array($subject["en"]))
                <span class="sidebar-item">
                    <i class="fi-star"></i>
                    <a href="{{ action('SearchController@search', ['subject' => $subject["en"]]) }}">{{ $subject["en"] }}</a>
                </span>
                @endif
                @endforeach
            </p>
        </div>
        @endif

        @if (array_key_exists("keyword", $study["_source"]))
                <div>
            <strong>Keywords</strong>
            <p>
                @foreach ($study["_source"]["keyword"] as $keyword)

                @if (is_array($keyword) && array_key_exists("en", $keyword))
                <span class="sidebar-item">
                    <i class="fi-burst"></i><a href="{{ action('SearchController@search', ['keyword' => $keyword["en"]]) }}">{{ $keyword["en"] }}</a>
                </span>
                @endif
                @endforeach
            </p>
        </div>
        @endif
    </div>
    <!-- /small-12.columns -->
</div>
<!-- /row -->
@endsection
