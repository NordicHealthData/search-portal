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
        //dd($id);
        $document = ElasticSearch::get($id, 'study');
        dd($document);
    }
}
