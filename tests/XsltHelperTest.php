<?php

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

    /**
     * @test
     */
    public function transformDdi31()
    {

        dd(getcwd());
        $test = '/tmp/ddi_archive/dda-213.xml';
        $this->helper->transform($test, '/tmp/');
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
        $this->helper->transform($test, '/tmp/');
        $testFile = '/tmp/NSD1962.xml.json';
        $result = file_exists($testFile);
        $this->assertTrue($result, 'Transformation file not found!, '.$testFile);
        //unlink($testFile);
    }
}