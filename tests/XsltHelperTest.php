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
    public function transformDdi31()
    {
        $test = '/tmp/ddi_archive/dda-213.xml';
        $this->helper->transform(XsltHelper::DDI3_1_TO_JSON, $test, '/tmp/');
        $testFile = '/tmp/dda-213.xml.json';
        $result = file_exists($testFile);
        $this->assertTrue($result, 'Transformation file not found!, '.$testFile);

        unlink($testFile);
        $this->helper->transform(XsltHelper::DDI3_1_TO_JSON, $test);
        $this->assertTrue($result, 'Transformation file not found!, '.$testFile);
    }

    /**
     * @test
     */
    public function transformDdi122()
    {
        $test = '/tmp/nsd/NSD1962.xml';
        $this->helper->transform(XsltHelper::DDI1_2_2_TO_JSON, $test, '/tmp/');
        $testFile = '/tmp/NSD1962.xml.json';
        $result = file_exists($testFile);
        $this->assertTrue($result, 'Transformation file not found!, '.$testFile);
        //unlink($testFile);
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
        $test = '/testdata/dda-213.xml';
        $fileName = $this->helper->getOutFileName($test);
        $this->assertEquals('dda-213.xml.json', $fileName, 'Not the same!');
    }
}