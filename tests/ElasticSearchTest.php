<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Providers\ElasticSearch;

class ElasticSearchTest extends TestCase
{
    /**
     * @test
     */
    public function deleteIndex() {
        // create an index
        ElasticSearch::indexDocument('sevensomething', 'thesuperindex', 'mytype', []);

        $exitCode = Artisan::call('es:delete-index', [
            'index' => 'thesuperindex'
        ]);

        $this->assertEquals(0, $exitCode, 'Ups something went rouge!');
    }

    /**
     * @test
     */
    public function isIndexCreated() {
        // create an index
        ElasticSearch::indexDocument('sevensomething', 'thesuperindex', 'mytype', []);

        $result = ElasticSearch::isIndexCreated('thesuperindex');
        $this->assertTrue($result);

        // clean up
        $exitCode = Artisan::call('es:delete-index', [
            'index' => 'thesuperindex'
        ]);
    }

    /**
     * @test
     */
    function createIndexFromJsonFile() {// clean up
        $exitCode = Artisan::call('es:delete-index', [
            'index' => 'study'
        ]);
        ElasticSearch::createIndexFromJsonFile();

        $result = ElasticSearch::isIndexCreated('study');
        $this->assertTrue($result);
    }
}