{!! Form::open(array("action" => "SearchController@search", "method" => "GET")) !!}
    <div class="row collapse">
        <div class="small-8 columns">
            {!! Form::text("q", Request::input("q"), array("class" => "search", "autocomplete" => "off", "placeholder" => "Search for Studies...", "data-suggesturl" => action("SearchController@suggest"))) !!}
        </div>
        <div class="small-4 columns">
            {!! Form::submit("Search", array("class" => "button")) !!}
        </div>
        <!--/small-12.columns -->
    </div>
    <!-- /row -->
{!! Form::close() !!}
