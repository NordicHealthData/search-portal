@extends('app')
@section('content')
    <div class="container jumbotron">
        <div class="content">
            <div class="title">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="favicon.ico" alt="Nordic health data">
                    </div>
                    <div class="media-body">
                        <h1>Nordic health data search portal</h1>
                    </div>
                </div>     
            </div>

            {!! Form::open(array("action" => "SearchController@search", "method" => "GET", "class" => "form-inline")) !!}            

                {!! Form::text("q", Request::input("q"), array("id" => "q", "class" => "form-control", "style" => "width:85%", "placeholder" => "Search for studies...")) !!}

                {!! Form::submit("Search", array("class" => "btn btn-primary")) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection