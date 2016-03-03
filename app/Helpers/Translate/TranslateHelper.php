<?php
/**
 * Created by PhpStorm.
 * User: ddajvj
 * Date: 9/1/15
 * Time: 5:34 PM
 */

namespace App\Helpers\Translate;
use App\Providers\TranslateProvider;

/**
 * Helper to translate variables, questions and concepts in json ddi files
 * @package app\Helpers\Translate
 */
class TranslateHelper {

    /**
     * @param $study to translate
     * @param TranslateContract $translator
     * @return mixed translated study
     */
    public function translate($study, TranslateContract $translator) {
        $count = 0;
        foreach($study["variable"] as $var) {
            // variable label
            if(!array_key_exists("en", $var["label"]) ) {
                $langs = array_keys($var["label"]);

                $study["variable"][$count]["label"]['en'] =
                    $translator->translate($var["label"][$langs[0]], $langs[0], 'en');
            }

            // question label
            if(array_key_exists("question", $var)) {
                if (!array_key_exists("en", $var["question"]["label"])) {
                    $langs = array_keys($var["question"]["label"]);

                    $study["variable"][$count]["question"]["label"]['en'] =
                        $translator->translate($var["question"]["label"][$langs[0]], $langs[0], 'en');
                }
            }

            // concept label
            if(array_key_exists("concept", $var)) {
                if (!array_key_exists("en", $var["concept"]["label"])) {
                    $langs = array_keys($var["concept"]["label"]);

                    $study["variable"][$count]["concept"]["label"]['en'] =
                        $translator->translate($var["concept"]["label"][$langs[0]], $langs[0], 'en');
                }
            }

            $count++;
        }

        return $study;
    }
}
