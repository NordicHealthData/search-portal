<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Providers\ElasticSearch;

class ElasticSearchDeleteIndexTest extends TestCase
{
    /**
     * @test
     */
    public function elasticSearchDeleteIndex() {
        // create an index
        ElasticSearch::indexDocument('sevensomething', 'thesuperindex', 'mytype', []);

        $exitCode = Artisan::call('es:delete-index', [
            'index' => 'thesuperindex'
        ]);

        $this->assertEquals(0, $exitCode, 'Ups something went rouge!');
    }
}