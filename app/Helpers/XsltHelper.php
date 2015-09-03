<?php
namespace App\Helpers;

/**
 * Class XsltHelper to facilitate transformation of XML
 * @package App\Helpers
 */
class XsltHelper{
    const DDI3_1_TO_JSON = 'ddi-json/ddi3_1/xsl/ddi3_1.xsl';
    const DDI1_2_2_TO_JSON = 'ddi-json/ddi1_2_2/xsl/ddi1_2_2.xsl';

    /**
     * @var \SaxonProcessor
     */
    public $proc;

    function __construct() {
        if(env('XSLT_USE_SAXON_EXTENSION')){
            $this->proc = new \SaxonProcessor('');
            \Log::info('Saxon Processor version: '.$this->proc->version());
        }
    }

    /**
     * Transform xml  via xslt to a directory
     * @param $xslt file of stylesheet to use
     * @param $xml xml file to transform
     * @throws \Exception on bad transformation
     */
    public function transform($xslt, $xml, $outPath = null) {
        // define output directory
        if(!isset($outPath)) {
            $outPath = env('XSLT_OUT_PATH');
        }

        $this->transformUsingBuiltInXslt($xml, $outPath);
        
        /*
        if(env('XSLT_USE_SAXON_EXTENSION')){
            $this->transformUsingSaxonExtension($xslt, $xml, $outPath);
        }else{
             $this->transformUsingSaxonJar($xslt, $xml, $outPath);
        }*/
    }
    
     /**
     * Transform xml  via PHP:s built in xslt processor
     * @param $filePath xml file to transform
     * @throws \Exception on bad transformation
     */
    private function transformUsingBuiltInXslt($filePath, $outPath){
	$source = file_get_contents($filePath);
	$xml = new \DOMDocument;
	$xml->loadXML($source);

	$version = $this->getDDIVersion($source);

	$xsl = new \DOMDocument;
	
	$xsl->load('resources/xslt/'.$version.'_json.xsl');
	
	$proc = new \XSLTProcessor;
	$proc->importStyleSheet($xsl); 

	$json_xml = $proc->transformToXML($xml);
	
	$json = json_encode(simplexml_load_string($json_xml));
        
        file_put_contents($outPath.basename($filePath).'.json', $json);
    }
       
    private function getDDIVersion(&$source){
        if (strpos($source,'ddi:instance:3_1') !== false) {
                return 'ddi_3_1';
        }else if(strpos($source,'xsi:schemaLocation="http://www.icpsr.umich.edu/DDI http://www.icpsr.umich.edu/DDI/Version1-2-2.xsd"') !== false){
                return 'ddi_1_2_2';
        }else if(strpos($source,'"http://www.icpsr.umich.edu/DDI/Version2-0.dtd"') !== false){
                return 'ddi_2_0';
        }
    }
    
    /**
     * Transform xml  via saoxon extension to a directory
     * @param $xslt file of stylesheet to use
     * @param $xml xml file to transform
     * @throws \Exception on bad transformation
     */
    private function transformUsingSaxonExtension($xslt, $xml, $outPath){
        // clear transformer
        $this->proc->clearParameters();
        $this->proc->clearProperties();

        // set files
        $this->proc->setSourceFile($xml);
        $xsltStr = file_get_contents((env('XSLT_BASE_LOCATION').$xslt));
        $this->proc->setStylesheetContent($xsltStr);

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
     * Transform xml  via saoxon jar to a directory
     * @param $xslt file of stylesheet to use
     * @param $xml xml file to transform
     * @throws \Exception on bad transformation
     */
    private function transformUsingSaxonJar($xslt, $xml, $outPath){
        $command = 'java -jar '.env('XSLT_SAXON_JAR_PATH').
                   ' -xsl:'.env('XSLT_BASE_LOCATION').$xslt.
                   ' -s:'.$xml.
                   ' -o:'.$outPath.$this->getOutFileName($xml);
        \Log::debug($command);
        exec($command);
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
        $filename .=  '.json';
        return $filename    ;
    }
}
