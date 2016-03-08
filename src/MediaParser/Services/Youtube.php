<?php 
namespace PS\MediaParser\Services;

use PS\MediaParser\Service;

class Youtube implements Service {

    static $serviceIdentifier = "youtube";

    /**
     * Tests to see if a string or URL actualy contains link to a youtube video
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to youtube video
     */
    static function match($string) {
        return preg_match('/(http(s)?:)?\/\/(www.)?youtube|youtu\.be/i', $string);
    }

    /**
     * Returns youtube video id from a given string. The string can be either url or iframe embed. 
     * @param  [string] $fromString input string that needs to be tested
     * @return [string|boolean] false if the id cannot be found or the id itself
     */
    static function parse($fromString) {
        $id = false;

        if (preg_match('/\.com\/embed\//', $fromString)) {
            $parts = explode('embed/', $fromString);
            $id = $parts[1];
            $parts = explode('"', $id);
            $id = $parts[0];
        } else {
            $parts = preg_split('/v\/|v=|youtu\.be\//', $fromString);
            $id = $parts[1];
            $parts = preg_split('/[?& ]/', $id);
            $id = $parts[0];
        }

        return $id;
    }

    /**
     * Generates an embed code for the youtube video 
     * @param  [string] $id the id that needs to be embeded
     * @return [string] the embedable code
     */
    static function embed($id) {
        return '<iframe frameborder="0" allowfullscreen src="//www.youtube.com/embed/'.$this->id.'"></iframe>';
    }

}