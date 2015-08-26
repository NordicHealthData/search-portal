<?php

namespace App\Http\Controllers;

use App\Providers\ElasticSearch;

class StudyController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        return view('study.index');
    }

    public function view($id) {
        $study = ElasticSearch::get(
                                    $id, 
                                    env('ES_STUDY_UNIT_INDEX'), 
                                    env('ES_STUDY_INDEX_TYPE')
                                );
        
        return view('study.view')
                ->with('study', $study);
    }
}
