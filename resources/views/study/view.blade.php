@extends('app')
@section('content')
    
@foreach($study['_source']['title'] as $title)
    @if(array_key_exists('en', $title))
        <h1>{{ $title['en'] }}</h1>
    @endif
@endforeach

<h3>Abstract</h3>
@foreach($study['_source']['abstract'] as $abstract)
    @if(array_key_exists('en', $abstract))
        <p>{{ $title['en'] }}</p>
    @endif
@endforeach

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