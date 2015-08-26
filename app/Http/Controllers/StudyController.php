<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use App\Providers\ElasticSearch;
use Illuminate\Support\Facades\Input;

Use Utils;
use Request;

class StudyController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        return view('study.index');
    }

    public function view($id) {
        $study = ElasticSearch::get($id, env('ES_STUDY_UNIT_INDEX'), env('ES_STUDY_INDEX_TYPE'));
        //dd($study);
        return view('study.view')
                ->with('study', $study);
    }
}
