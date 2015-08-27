{!! Form::open(array("action" => "SearchController@search", "method" => "GET")) !!}
    <div class="row collapse">
        <div class="small-12 columns">
            {!! Form::text("q", Request::input("q"), array("class" => "search", "autocomplete" => "off", "placeholder" => "Search for Studies...")) !!}
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
{!! Form::close() !!}
