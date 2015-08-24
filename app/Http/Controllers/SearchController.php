<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use App\Services\ElasticSearch;
use App\Services\Utils;
use Request;

class SearchController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        return view('search.simpleSearch');
    }

    /**
     * Performs a faceted search depending on the GET-values
     * 
     * @return View rendered pagination for search results
     */
    public function search() {
        $query = ['aggregations' => Config::get('app.elastic_search_aggregations')];

        if (Request::has('q')) {
            $q = ['query_string' => ['query' => Request::get('q')]];
            $query['query']['bool']['must'][] = $q;
        }

        foreach ($query['aggregations'] as $key => $aggregation) {
            if (Request::has($key)) {
                $values = Utils::getArgumentValues($key);

                $field = $aggregation['terms']['field'];

                foreach ($values as $value) {
                    $fieldQuery = [];
                    $fieldQuery[$field] = $value;
                    $query['query']['bool']['must'][] = ['match' => $fieldQuery];
                }
            }
        }

        $hits = ElasticSearch::search($query, 'resource');
        
        return view('search.simpleSearch')
                        ->with('type', null)
                        ->with('aggregations', $query['aggregations'])
                        ->with('hits', $hits);
    }
}
