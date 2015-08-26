<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchControllerTest extends TestCase {

    /**
     * @var Illuminate\Http\Response
     */
    var $response;

    /**
     * @test
     */
    public function suggest() {
        $this->response = $this->action('GET', 'SearchController@suggest', ['text' => 'surv']);
        var_dump($this->response->content());
        $this->assertEquals(200, $this->response->getStatusCode(), 'Doo not a 200, but a: '.$this->response->getStatusCode());
    }
}