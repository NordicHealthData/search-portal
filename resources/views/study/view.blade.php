@extends("layouts.default")

@section("content")
  <div class="row">
      <div class="small-12 columns">
          @foreach ($study["_source"]["title"] as $title)
              @if (array_key_exists("en", $title))
                  <h1>{{ $title["en"] }}</h1>
              @endif
          @endforeach

          <p><strong>ID:</strong> <span>{{ $study["_id"] }}</span><br /></p>

          @if ($study["_source"]["landingpage"])
              <p><a href="{{ $study["_source"]["landingpage"] }}">{{ $study["_source"]["landingpage"] }}</a></p>
          @endif

          <h3>Abstract</h3>

          @foreach ($study["_source"]["abstract"] as $abstract)
              @if (array_key_exists("en", $abstract))
                  <p>{{ $abstract["en"] }}</p>
              @endif
          @endforeach

          @if (array_key_exists("purpose", $study["_source"]))
          <h3>Purpose</h3>

          @foreach ($study["_source"]["purpose"] as $purpose)
              @if (array_key_exists("en", $purpose))
                  <p>{{ $purpose["en"] }}</p>
              @endif
          @endforeach
          @endif
          
          <h3>Subjects</h3>

          <ul>
              @foreach ($study["_source"]["subject"] as $subject)
                  @if (array_key_exists("en", $subject))
                      <li><a href="/search?subject={{ $subject["en"] }}">{{ $subject["en"] }}</a></li>
                  @endif
              @endforeach
          </ul>

          <h3>Keywords</h3>

          <ul>
              @foreach ($study["_source"]["keyword"] as $keyword)
                  @if (array_key_exists("en", $keyword))
                      <li><a href="/search?subject={{ $keyword["en"] }}">{{ $keyword["en"] }}</a></li>
                  @endif
              @endforeach
          </ul>

          <p>
              @if (array_key_exists("startdate", $study["_source"]))
                  <strong>Start date:</strong> <span>{{ $study["_source"]["startdate"] }}</span><br />
              @endif
              @if (array_key_exists("enddate", $study["_source"]))
                  <strong>Start date:</strong> <span>{{ $study["_source"]["enddate"] }}</span><br />
              @endif
          </p>

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
      <!-- /small-12.columns -->
  </div>
  <!-- /row -->
@endsection
