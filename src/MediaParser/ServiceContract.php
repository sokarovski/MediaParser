<?php
namespace PS\MediaParser;

interface ServiceContract {

    /**
     * Tests to see if a string or URL actualy contains link to a media
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to youtube video
     */
    static function match($string);

    /**
     * Generates an embed code for the service 
     * @param  [string] $id the id that needs to be embeded
     * @return [string] the embedable code
     */
    public function embed();

}