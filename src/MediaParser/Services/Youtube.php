<?php 
namespace PS\MediaParser\Services;

use PS\MediaParser\ServiceContract;
use PS\MediaParser\Result;

class Youtube extends Result implements ServiceContract {

    static $type = "youtube";

    /**
     * Tests to see if a string or URL actualy contains link to a youtube video
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to youtube video
     */
    static function match($string) {
        return preg_match('/(http(s)?:)?\/\/(www.)?youtube|youtu\.be/i', $string);
    }

    /**
     * Parses a string into a result
     * @param  [string] $fromString input string that needs to be tested
     * @return [boolean] weather parsing was succesfull or not
     */
    protected function parse($fromString) {
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
        
        $this->id = $id;
        return $id !== false;
    }

    /**
     * Generates an embed code for the youtube video 
     * @param  [string] $id the id that needs to be embeded
     * @return [string] the embedable code
     */
    public function embed() {
        return '<iframe frameborder="0" allowfullscreen src="'.$this->getLink().'"></iframe>';
    }

    public function getLink() {
        return '//www.youtube.com/embed/'.$this->id;
    }

}