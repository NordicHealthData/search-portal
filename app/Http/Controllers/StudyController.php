<?php

namespace App\Http\Controllers;

use App\Providers\ElasticSearch;

use Utils;

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
        
        
        $study['_source']['landingpage'] = Utils::getLandingPage($study['_source']['repository'], $study['_id']);
        
        //dd($study);
        return view('study.view')
                ->with('study', $study);
    }
}
