<?php

namespace App\Helpers;

/**
 * Class HarminizationHelper to
 */
class HarminizationHelper {

  private static $lookup = NULL;

  private static function getLookup() {
    if (is_null(self::$lookup)) {
      $content = file_get_contents('resources/harmonization/ddi_cv.json');
      self::$lookup = json_decode($content, true);
    }
    return self::$lookup;
  }

  /**
   * Fixes the values from controlled vocabularies
   * 
   * @param type $document
   * @return array
   */
  public static function harmonizeDocument($document) {
    
    $lookup = self::getLookup();

    foreach ($lookup as $key => $mappings) {

      if (array_key_exists($key, $document)) {
        foreach ($mappings as $cvValue => $synonyms) {

          if (in_array($document[$key], $synonyms)) {
            $document[$key] = $cvValue;
          }
        }
      }
    }

    return $document;
  }

}
