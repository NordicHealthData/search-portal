<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Helpers\XsltHelper;

class XsltHelperTest extends TestCase
{
    /**
     * @var App\Helpers\XsltHelper;
     */
    protected $helper;

    public function setUp()
    {
        $this->helper = new XsltHelper();
    }

    public function tearDown()
    {
        unset($this->helper->proc);
    }

    /**
     * @test
     */
    public function transform()
    {
        $this->helper->transform(XsltHelper::DDI3_1_TO_JSON,
            $this->helper->getBaseXsltLocation().'../testdata/dda-213.xml', '/tmp/');
        $testFile = '/tmp/dda-213.json';
        $result = file_exists($testFile);
        $this->assertTrue($result, 'Transformation file not found!, '.$testFile);

        unlink($testFile);
        $this->helper->transform(XsltHelper::DDI3_1_TO_JSON,
            $this->helper->getBaseXsltLocation().'../testdata/dda-213.xml');
        $this->assertTrue($result, 'Transformation file not found!, '.$testFile);
    }

    /**
     * @test
     */
    public function getBaseXsltLocation() {
        $this->assertNotEmpty($this->helper->getBaseXsltLocation(), 'Empty base xslt location!');
    }

    /**
     * @test
     */
    public function getOutFileName() {
        $fileName = $this->helper->getOutFileName('/testdata/dda-213.xml');
        $this->assertEquals('dda-213.json', $fileName, 'Not the same!');
    }
}