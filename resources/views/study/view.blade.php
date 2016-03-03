@extends("layouts.default")

@section("content")
<div id="study" class="row">
    
    <h1 class="title" >{{ Utils::getEn($study["_source"]["title"]) }}</h1>
    
    <div class="small-10 columns">
            @if ($study["_source"]["landingpage"])
            <p>
                <a class="landingpage" href="{{ $study["_source"]["landingpage"] }}" title="If you have any questions regarding this data set please refer your questions to the archive responsible for the study.">
                    <i class="fi-link"></i>
                    Access resource at host archive
                </a>
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
    <div  class="small-2 columns sidebar">

        @if (array_key_exists("subject", $study["_source"]))
        <div id = "subject">
            <h3 class = "subject">Subjects</h3>

            <ul class = "subjectul">
                @foreach ($study["_source"]["subject"] as $subject)
                @if (is_array($subject) && array_key_exists("en", $subject))
                <li><a href="{{ action('SearchController@search', ['subject' => $subject["en"]]) }}">{{ $subject["en"] }}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
        @endif

        @if (array_key_exists("keyword", $study["_source"]))
        <div id="keyword">
            <h3 class = "keyword">Keywords</h3>
            <ul class = "keywordul">
                @foreach ($study["_source"]["keyword"] as $keyword)
                @if (is_array($keyword) && array_key_exists("en", $keyword))
                <li><a href="{{ action('SearchController@search', ['keyword' => $keyword["en"]]) }}">{{ $keyword["en"] }}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
        @endif
        
        @if (count($study['related'] < 0))
        <div id="related">
            <h3 class = "related">Related studies</h3>
            <ul class = "relatedul">
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
