@extends("layouts.default")

@section("content")
<div class="row">
    <div class="small-12 columns">

        <h1>{{ Utils::getEn($study["_source"]["title"]) }}</h1>

        <p><strong>ID:</strong> <span>{{ $study["_id"] }}</span><br /></p>

        @if ($study["_source"]["landingpage"])
        <p><a href="{{ $study["_source"]["landingpage"] }}">{{ $study["_source"]["landingpage"] }}</a></p>
        @endif

        @if (array_key_exists("abstract", $study["_source"]))
        <h3>Abstract</h3>

        <p>{{ Utils::getEn($study["_source"]["abstract"]) }}</p>
        @endif

        @if (array_key_exists("purpose", $study["_source"]))
        <h3>Purpose</h3>

        <p>{{ Utils::getEn($study["_source"]["purpose"]) }}</p>
        @endif

        @if (array_key_exists("subject", $study["_source"]))
        <h3>Subjects</h3>

        <ul>
            @foreach ($study["_source"]["subject"] as $subject)
            @if (array_key_exists("en", $subject))
            <li><a href="{{ action('SearchController@search', ['subject' => $subject["en"]]) }}">{{ $subject["en"] }}</a></li>
            @endif
            @endforeach
        </ul>
        @endif

        @if (array_key_exists("keyword", $study["_source"]))
        <h3>Keywords</h3>
        <ul>
            @foreach ($study["_source"]["keyword"] as $keyword)
            @if (array_key_exists("en", $keyword))
            <li><a href="{{ action('SearchController@search', ['keyword' => $keyword["en"]]) }}">{{ $keyword["en"] }}</a></li>
            @endif
            @endforeach
        </ul>
        @endif

        <p>
            @if (array_key_exists("startdate", $study["_source"]))
            <strong>Start date:</strong> <span>{{ $study["_source"]["startdate"] }}</span><br />
            @endif
            @if (array_key_exists("enddate", $study["_source"]))
            <strong>End date:</strong> <span>{{ $study["_source"]["enddate"] }}</span><br />
            @endif
        </p>

        @if (array_key_exists("creator", $study["_source"]))
        <h3>Creator</h3>

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
    </div>
    @endif
    <!-- /small-12.columns -->
</div>
<!-- /row -->
@endsection
