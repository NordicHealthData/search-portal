<?php

namespace App\Helpers\Translate;

/**
 * Interface TranslateContract
 * @package app\Helpers\Translate
 */
interface TranslateContract {
    public function translate($text, $fromLang, $toLang);
    public function detectLanguage($text);
}