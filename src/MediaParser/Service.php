<?php
namespace PS\MediaParser;

interface Service {

    /**
     * Tests to see if a string or URL actualy contains link to a media
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to youtube video
     */
    static function match($string);

    /**
     * Returns media id from a given string. The string can be either url or iframe embed. 
     * @param  [string] $fromString input string that needs to be tested
     * @return [string|boolean] false if the id cannot be found or the id itself
     */
    static function parse($fromString);

    /**
     * Generates an embed code for the service 
     * @param  [string] $id the id that needs to be embeded
     * @return [string] the embedable code
     */
    static function embed($id);

}