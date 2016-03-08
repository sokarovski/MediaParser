<?php 
namespace PS\MediaParser\Services;

use PS\MediaParser\Service;

class Vimeo implements Service {

    static $serviceIdentifier = "vimeo";

    /**
     * Tests to see if a string or URL actualy contains link to a vimeo video
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to vimeo video
     */
    static function match($string) {
        return preg_match('/http(s)?:\/\/(player.)?vimeo\.com/ig', $string);
    }

    /**
     * Returns vimeo video id from a given string. The string can be either url or iframe embed. 
     * @param  [string] $fromString input string that needs to be tested
     * @return [string|boolean] false if the id cannot be found or the id itself
     */
    static function parse($fromString) {
        $id = false;
        $parts = explode('/', $url);
        $id = array_pop($parts);
        $parts = preg_split('/[?&]/', $id);
        $id = $parts[0];
        return $id;
    }

    /**
     * Generates an embed code for the vimeo video 
     * @param  [string] $id the id that needs to be embeded
     * @return [string] the embedable code
     */
    static function embed($id) {
        return '<iframe frameborder="0" allowfullscreen src="//player.vimeo.com/video/'.$this->id.'"></iframe>';
    }

}