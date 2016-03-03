@extends("layouts.default")

@section("content")
<div class="row">
    <div class="small-8 columns">
            <h1 class="title" >{{ Utils::getEn($study["_source"]["title"]) }}</h1>

            @if ($study["_source"]["landingpage"])
                <p>
                <strong>Link to the archive hosting the research data: <a href="{{ $study["_source"]["landingpage"] }}">{{ $study["_source"]["landingpage"] }}</a></strong>
                <br>
                If you have any questions regarding this data set please refer your questions to the archive responsible for the study.
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
                <br>
            </p>
            @if (array_key_exists("creator", $study["_source"]))
            <h3>Principal investigator</h3>

            <ul>
                @foreach ($study["_source"]["creator"] as $creator)
                @if (array_key_exists("en", $creator))
                <li>{{ $creator["en"] }}</li>
                @endif
                @if (array_key_exists("undefLang", $creator))
                <li>{{ $creator["undefLang"] }}</li>
                @endif
                @endforeach
            </ul>
            @endif



            <p>

            @if (array_key_exists("universe", $study["_source"]))
            <h3>Universe</h3>
            <ul>
                @foreach ($study["_source"]["universe"] as $universe)
                @if (array_key_exists("en", $universe))
                <li>{{ Utils::getEn($study["_source"]["universe"]) }}</li>
                @endif
                @endforeach
            </ul>
            @endif

            @if (array_key_exists("abstract", $study["_source"]))
            <h3>Abstract</h3>

            <p class="abstract" >{{ Utils::getEn($study["_source"]["abstract"]) }}</p>

            @endif

            @if (array_key_exists("purpose", $study["_source"]))
            <h3>Purpose</h3>

            <p>{{ Utils::getEn($study["_source"]["purpose"]) }}</p>
            @endif




    </div>
    <div  class="small-4 columns">

        @if (array_key_exists("subject", $study["_source"]))
        <div>
            <strong>Subjects</strong>

            <p>
                @foreach ($study["_source"]["subject"] as $subject)
                @if (is_array($subject) && array_key_exists("en", $subject))
                &bullet; <a href="{{ action('SearchController@search', ['subject' => $subject["en"]]) }}">{{ $subject["en"] }}</a>
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
                &bullet; <a href="{{ action('SearchController@search', ['keyword' => $keyword["en"]]) }}">{{ $keyword["en"] }}</a>
                @endif
                @endforeach
            </p>
        </div>
        @endif

        @if (count($study['related'] < 0))
        <div>
            <strong>Related studies</strong>
            <ul>
                @foreach ($study["related"] as $related)
                <li><a href="{{ action('StudyController@view', ['id' => $related["_id"]]) }}">{{ Utils::getEn($related["_source"]["title"]) }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <!-- /small-12.columns -->
</div>
<!-- /row -->
@endsection
