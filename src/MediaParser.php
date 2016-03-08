<?php 
namespace PS;

use PS\MediaParser\Result;

class MediaParser {

    /**
     * List of testing services that are going to be iterated and matched before the parser will 
     * return the result
     * @var array
     */
    static $services = array(
        \PS\MediaParser\Services\Youtube::class,
        \PS\MediaParser\Services\Vimeo::class,
    );

    /**
     * Returns media id from a given string. The string can be either url or iframe embed. 
     * @param  [string] $fromString input string that needs to be tested
     * @return [Result] false if the id cannot be found or Result object otherwise
     */
    static function parse($string) {
        foreach (self::$services as $service) {
            if ($service::match($string))
                return new Result($service, $service::parse($string));
        }

        return false;
    }

    /**
     * Register a new service to the array of services so it will be tested when the parser is run.
     * @todo test the interface
     * @param  [string] $service fully qualified class name that implements MediaParser/Service interface
     */
    static function registerService($service) {
        self::$services[] = $service;
    }

}