<?php
namespace App\Helpers;

/**
 * Class XsltHelper to facilitate transformation of XML
 * @package App\Helpers
 */
class XsltHelper{

    function __construct() {

    }

    /**
     * Transform xml  via xslt to a directory
     * @param $xslt file of stylesheet to use
     * @param $xml xml file to transform
     * @throws \Exception on bad transformation
     */
    public function transform($xml, $outPath = null) {
        // define output directory
        if(!isset($outPath)) {
            $outPath = env('XSLT_OUT_PATH');
        }

        $this->transformUsingBuiltInXslt($xml, $outPath);
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
