<?php

namespace App\Helpers\Translate;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Translate implementation based on: https://github.com/eko/GoogleTranslateBundle
 * Remember to setup Google cloud account at: https://console.developers.google.com/
 * @package App\Helpers\Translate
 */
class GoogleTranslate implements TranslateContract {

    private $apiUrl;
    private $apiKey;

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * Default constructor, hmm php ...
     */
    public function __construct() {
        // init the translator
        $this->apiKey = env('TRANSLATE_GOOGLE_API_KEY');
        $this->apiUrl = env('TRANSLATE_GOOGLE_API_URL');
        $this->client = new GuzzleClient();
    }

    /**
     * Translate a text from one language to another
     * @param $text mixed|string to translate
     * @param $toLang from language
     * @param $toLang to language
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

    public function detectLanguage($text) {

    }

    protected function translateImplementation($text, $fromLang, $toLang)
    {
        $options = array(
            'key' => $this->apiKey,
            'q' => $text,
            'source' => $fromLang,
            'target' => $toLang
        );

        $json = $this->client->get($this->apiUrl, array('query' => $options))->json();
        \Log::debug('Google translate result:', $json);

        $result = null;
        if (isset($json['data']['translations'])) {
            $current = current($json['data']['translations']);
            $result = $current['translatedText'];
        }
        return $result;
    }
}