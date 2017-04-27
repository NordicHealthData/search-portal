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
                                    env('ELASTICSEARCH_STUDY_UNIT_INDEX'), 
                                    env('ELASTICSEARCH_STUDY_INDEX_TYPE')
                                );
        
        $study['related'] = StudyController::thematicallySimilarQuery($study);
        
        $study['_source']['landingpage'] = Utils::getLandingPage($study['_source']['repository'], $study['_id']);
        
        //dd($study);
        return view('study.view')
                ->with('study', $study);
    }
    
    /**
     * @param $study
     * @return the seven most similar studies based on subjects
     */
    public static function thematicallySimilarQuery($resource) {

$json = '{
        "query": {
          "bool": {
            "must_not": {
              "match": {
                "_id": "' . $resource['_id'] .  '"
              }
            },
            "should": [';

        $firstMatch = true;

        if (array_key_exists('nativeSubject', $resource['_source'])) {
            foreach ($resource['_source']['keyword']['en'] as $subject) {
                
                if ($firstMatch)
                    $firstMatch = false;
                else
                    $json .= ',';

                $json .= '{
              "match": {
                "keyword.en": "' . $subject . '"
              }
            }';
            }
        }

        $json .= '],
              "minimum_should_match" : 1
            }
          }
        }';

        $params = [
            'index' => 'study',
            'type' => 'studytype',
            'size' => 7,
            'body' => $json
        ];

        $result = ElasticSearch::getClient()->search($params);
        return $result['hits']['hits'];
    }
}
