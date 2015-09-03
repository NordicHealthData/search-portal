<?php 
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Input;
use App\Providers\ElasticSearch;

class Utils extends ServiceProvider{

    /**
     * Register application service.
     *
     * @return void
     */
    public function register()
    {
        //
    }    
    
    public static function getEn($array){
        if(!is_array($array)){
            return $array;
        }else if(array_key_exists('en', $array)){
            return $array['en'];
        }else{
            foreach($array as $key => $value){
                if(array_key_exists('en', $value)){
                    return $value['en'];
                }
            }
        }
    }
    
    public static function contains($string, array $array){
        foreach($array as $item) {
            if (stripos($string, $item) !== false) return true;
        }
        return false;
    }
    
    public static function containsAndNotContains($string, array $array, $stringNeg){
        foreach($array as $item) {
            if (stripos($string, $item) !== false && stripos($string, $stringNeg) == false) return true;
        }
        return false;
    }
    
    /**
     * Adds a value to a new parameter or adds it to the list of an existing
     * 
     * @param string $key
     * @param string $value
     * @return Array
     */
    public static function addKeyValue($key, $value) {
        $arguments = Input::all();
        if(array_key_exists($key, $arguments)){
            $arguments[$key] = $arguments[$key]."|".$value;
        } else {
            $arguments[$key] = $value;
        }
        
        if(array_key_exists('page', $arguments)){
            unset($arguments['page']);
        }
        
        return $arguments;
    }
 
    /**
     * Removes value from list or deletes key if value becomes empty
     * 
     * @param string $key
     * @param string $value
     * @return Array
     */
    public static function removeKeyValue($key, $value) {
        $arguments = Input::all();
        if(array_key_exists($key, $arguments)){
            if($arguments[$key] == $value){
                unset($arguments[$key]);
            } else if(strpos(urldecode($arguments[$key]), '|') !== FALSE){
                $values = explode('|', urldecode($arguments[$key]));
                if(($index = array_search($value, $values)) !== false) {
                    unset($values[$index]);
                    $arguments[$key] = implode('|', $values);
                }
            }
            
        }
        
        if(array_key_exists('page', $arguments)){
            unset($arguments['page']);
        }
        
        return $arguments;
    }    
    
    /**
     * Get a list of values for a specific key and returns them as an array
     * 
     * @param string $key
     * @return Array
     */
    public static function getArgumentValues($key) {
        $arguments = Input::all();
        if(array_key_exists($key, $arguments) && strpos(urldecode($arguments[$key]), '|') !== FALSE){
            return explode('|', urldecode($arguments[$key]));
        }else{
            return array($arguments[$key]);
        }
    }        
    
    /**
     * Checks if a specified value is set for a paramter
     * Also checks if its in a comma separetd list
     * 
     * @param type $key key to lock for
     * @param type $value expected value or value in list
     * @return boolean
     */
    public static function keyValueActive($key, $value) {
        $arguments = Input::all();
        if(array_key_exists($key, $arguments)){
            $values = explode("|", $arguments[$key]);
            return in_array($value, $values);
        } 
        return false;
    }
    
    /**
     * Sets a set of specified values and keep all existing
     * 
     * @param Array $keyValues key-value pairs for values to set
     * @return Array
     */
    public static function setValues($keyValues = array()) {
        $arguments = Input::all();
        foreach($keyValues as $key => $value) {
            $arguments[$key] = $value;
        }
        return $arguments;
    }
    
    /**
     * Fix non iso dates
     * @param string $date
     * @return string
     */
    public static function fixDate($date){
        $fixedDate = str_replace('-00', '', $date);
        return $fixedDate;
    }
    
    /**
     * Generates the landign page
     * @param string $agency agancy
     * @param string $id if for the study
     * @return string URL
     */
    public static function getLandingPage($agency, $id){
        $agency = strtolower($agency);
        switch($agency){
            case 'fsd':
                return 'http://www.fsd.uta.fi/en/data/catalogue/FSD'.$id;
                break;
            case 'se.snd':
                return 'http://snd.gu.se/en/catalogue/study/'.str_replace(' ', '', $id);
                break;
            case 'dk.dda':
                return 'http://dda.dk/catalogue/'.$id;
                break;
            case 'nsd':
                return 'http://nsddata.nsd.uib.no/webview/?submode=abstract&mode=documentation&study=http://nsddata.nsd.uib.no/obj/fStudy/NSD'.$id;
                break;
            default:
                return '';
        }
    }
}