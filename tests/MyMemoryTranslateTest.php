<?php
namespace App\Helpers\Translate;

use TestCase;

class MyMemoryTranslateTest  extends TestCase {

    /**
     * @test
     */
    public function translate() {
        $app = require __DIR__.'/../bootstrap/app.php';
        $test = $app['App\Helpers\Translate\MyMemoryTranslate'];
        $result = $test->translate('jeg går med hunden gennem byen og solen skinner. Perfekt :)', 'da', 'en');
        $this->assertEquals('I go with the dog through the city and the Sun is shining. Perfect:)',
            $result, 'Not the same translation : (');
    }
}