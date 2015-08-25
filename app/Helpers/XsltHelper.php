<?php
namespace App\Helpers;

/**
 * Class XsltHelper to facilitate transformation of XML
 * @package App\Helpers
 */
class XsltHelper{
    const DDI3_1_TO_JSON = 'ddi-json/ddi3_1/xsl/ddi3_1.xsl';

    /**
     * @var \SaxonProcessor
     */
    public $proc;

    function __construct() {
        $this->proc = new \SaxonProcessor('');
        \Log::info('Saxon Processor version: '.$this->proc->version());
    }

    /**
     * Transform xml  via xslt to a directory
     * @param $xslt file of stylesheet to use
     * @param $xml xml file to transform
     * @throws \Exception on bad transformation
     */
    public function transform($xslt, $xml, $outPath = null) {
        // clear transformer
        $this->proc->clearParameters();
        $this->proc->clearProperties();

        // set files
        $this->proc->setSourceFile($xml);
        $xsltStr = file_get_contents((env('XSLT_BASE_LOCATION').$xslt));
        $this->proc->setStylesheetContent($xsltStr);

        // define output directory
        if(!isset($outPath)) {
            $outPath = env('XSLT_OUT_PATH');
        }

        // do transformation
        try {
            $this->proc->transformToFile($outPath.$this->getOutFileName($xml));
        } catch(Exception $e) {
            \Log::error('XSLT tansformation error', ['Msg'=>$e->getMessage(),
                'Xslt'=>$xslt, 'Xml'=>$xml]);
            throw $e;
        }
    }

    /**
     * Get the base location path of XSLT stylesheets
     * @return mixed
     */
    public function getBaseXsltLocation() {
        return env('XSLT_BASE_LOCATION', '');
    }

    /**
     * Get the json file name
     * @param $xml xml file as basis to the json file
     * @return string json file name
     */
    public function getOutFileName($xml) {
        $filename = substr(strrchr($xml, "/"), 1);
        $outFile = substr($filename, 0, strpos($filename, "."));
        $outFile .= '.json';
        return $outFile;
    }
}
