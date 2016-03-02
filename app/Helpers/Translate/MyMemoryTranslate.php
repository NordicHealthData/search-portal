<?php

namespace App\Helpers\Translate;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Translate implementation using http://mymemory.translated.net
 * Create login here: https://www.translated.net/top/?ref=mm for using TRANSLATE_MYMEMORY_MAIL option
 * @package App\Helpers\Translate
 */
class MyMemoryTranslate implements TranslateContract {

    /**
     * @var string
     */
    private $apiMail;

    /**
     * @var string
     */
    private $apiUrl = 'http://api.mymemory.translated.net/get';

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * Constructor
     */
    public function __construct() {
        $this->apiMail = env('TRANSLATE_MYMEMORY_MAIL');
        $this->client = new GuzzleClient();
    }

    /**
     * Translate a text from one language to another
     * @param $text mixed|string to translate
     * @param $toLang from language Use ISO standard names or RFC3066
     * @param $toLang to language Use ISO standard names or RFC3066
     */
    public function translate($text, $fromLang, $toLang) {
        // guzzel curl: yes

        if (!is_array($text)) {
            return $this->translateImplementation($text, $fromLang, $toLang);
        }

        $results = array();
        foreach ($text as $item) {
            $results[] = $this->translateImplementation($item, $fromLang, $toLang);
        }
        return $results;
    }

    /**
     * Not implemented by the MyMemory api
     * @param $text
     * @return string
     */
    public function detectLanguage($text) {
        return '';
    }

    protected function translateImplementation($text, $fromLang, $toLang)
    {
        $options = array(
            'q' => $text,
            'langpair' => $fromLang.'|'.$toLang
        );

        if(isset($this->apiMail)) {
            $options['de'] = $this->apiMail;
        }

        $json = $this->client->get($this->apiUrl, array('query' => $options))->json();
        \Log::debug('Translate result:', $json);

        $result = null;
        if (isset($json['responseData']['translatedText'])) {
            $result = $json['responseData']['translatedText'];
        }
        return $result;
    }
}