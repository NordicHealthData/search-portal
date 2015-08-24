@extends('app')
@section('content')
    
<aside class="right-side">                
    <!-- Main content -->
    <section class="content-header">
        <h1>
            Search
            <small>This is the search page</small>
        </h1>
        <hr>
    </section>
    <!-- Main content -->
    <section class="content">
        

        <div class="row">
            {!! $hits->appends(Input::all())->render() !!}
        </div>
   </section>             
</aside>
@endsection