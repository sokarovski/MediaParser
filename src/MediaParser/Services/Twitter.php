<?php 
namespace PS\MediaParser\Services;

use PS\MediaParser\ServiceContract;
use PS\MediaParser\Result;

class Twitter extends Result implements ServiceContract {

    static $type = "twitter";

    /**
     * Tests to see if a string or URL actualy contains link to a tweet
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to tweet or not
     */
    static function match($string) {
        return preg_match('/\/(www\.)?twitter\.com\/[a-zA-Z0-9_]{1,15}\/status\/\d+/i', $string);
    }

    /**
     * Parses a string into a result
     * @param  [string] $fromString input string that needs to be tested
     * @return [boolean] weather parsing was succesfull or not
     */
    protected function parse($fromString) {
        $matches = array();
        if (preg_match('/\/(www\.)?twitter\.com\/([a-zA-Z0-9_]{1,15})\/status\/(\d+)/i', $fromString, $matches)) {
            $this->setParameter('username', $matches[2]);
            $this->id = $matches[3];
            return true;
        }
        
        return false;
    }

    /**
     * Generates an embed code for the vimeo video 
     * @param  [string] $id the id that needs to be embeded
     * @return [string] the embedable code
     */
    public function embed() {
        return '<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr"> <a href="'.$this->getLink().'">date</a></blockquote> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
    }

    /**
     * Get the representative link of the current media
     * @return [string] link to the media
     */
    public function getLink() {
        return 'https://twitter.com/'.$this->getParameter('username').'/status/'.$this->id;
    }

}