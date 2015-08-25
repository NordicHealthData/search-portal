@extends('app')
@section('content')
    
@foreach($study['_source']['title'] as $title)
    @if(array_key_exists('en', $title))
        <h1>{{ $title['en'] }}</h1>
    @endif
@endforeach

<p>
    @if(array_key_exists('startdate', $study['_source']))
    <strong>ID:</strong> <span>{{ $study['_id'] }}</span><br />
    @endif    
</p>

<h3>Abstract</h3>
@foreach($study['_source']['abstract'] as $abstract)
    @if(array_key_exists('en', $abstract))
        <p>{{ $abstract['en'] }}</p>
    @endif
@endforeach

<h3>Purpose</h3>
@foreach($study['_source']['purpose'] as $purpose)
    @if(array_key_exists('en', $purpose))
        <p>{{ $purpose['en'] }}</p>
    @endif
@endforeach

<h3>Subjects</h3>
<ul>
@foreach($study['_source']['subject'] as $subject)
    @if(array_key_exists('en', $subject))
        <li><a href="/search?subject={{ $subject['en'] }}">{{ $subject['en'] }}</a></li>
    @endif
@endforeach
</ul>

<h3>Keywords</h3>
<ul>
@foreach($study['_source']['keyword'] as $keyword)
    @if(array_key_exists('en', $keyword))
        <li><a href="/search?subject={{ $keyword['en'] }}">{{ $keyword['en'] }}</a></li>
    @endif
@endforeach
</ul>

<p>
    @if(array_key_exists('startdate', $study['_source']))
    <strong>Start date:</strong> <span>{{ $study['_source']['startdate'] }}</span><br />
    @endif
    @if(array_key_exists('enddate', $study['_source']))
    <strong>Start date:</strong> <span>{{ $study['_source']['enddate'] }}</span><br />
    @endif    
</p>


<h3>Creator</h3>
<ul>
@foreach($study['_source']['creator'] as $creator)
    <li>{{ $creator }}</li>
@endforeach
</ul>


<p>
    
</p>


@endsection