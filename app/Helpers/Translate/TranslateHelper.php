<?php
/**
 * Created by PhpStorm.
 * User: ddajvj
 * Date: 9/1/15
 * Time: 5:34 PM
 */

namespace app\Helpers\Translate;

/**
 * Helper to translate variables in json ddi files
 * @package app\Helpers\Translate
 */
class TranslateHelper {

    public function translate($path) {
        $files = array_diff(scandir($path), array('..', '.'));
        foreach($files as $file) {
            if(file_exists($path.$file)) {
            }
        }
    }
}