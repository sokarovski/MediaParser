<?php 
namespace PS\MediaParser\Services;

use PS\MediaParser\ServiceContract;
use PS\MediaParser\Result;

class Vimeo extends Result implements ServiceContract {

    static $type = "vimeo";

    /**
     * Tests to see if a string or URL actualy contains link to a vimeo video
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to vimeo video
     */
    static function match($string) {
        return preg_match('/http(s)?:\/\/(player.)?vimeo\.com/i', $string);
    }

    /**
     * Parses a string into a result
     * @param  [string] $fromString input string that needs to be tested
     * @return [boolean] weather parsing was succesfull or not
     */
    protected function parse($fromString) {
        $isSluged = preg_match('/vimeo\.com\/(?!channels\/|video\/)[a-z0-9\-\_]+\/[a-z0-9\-\_]+( |$|"){1}/i', $fromString);
        if ($isSluged) {
            $fromString = self::followFinalUrl($fromString);
            if (!preg_match('/vimeo\.com\/(video\/)?[0-9]+/i', $fromString) )
                return false;
        }

        $matches = array();
        if (preg_match('/vimeo\.com\/(video\/|channels\/[a-z0-9\-\_]+\/)?(\d+)/i', $fromString, $matches)) {
            $this->id = $matches[2];
            return true;
        }
        
        return false;
    }

    /**
     * Follows an url until it redirects so we can get the final effective url
     * @param  [string] $sluged an url that needs to be followed
     * @return [string] the final url
     */
    private static function followFinalUrl($sluged) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
        curl_setopt($ch, CURLOPT_URL, 'https://vimeo.com/joshuatate/guestroom');
        curl_setopt($ch, CURLOPT_REFERER, "http://vimeo.com");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type:application/x-www-form-urlencoded"));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_exec($ch);
        return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    }

    /**
     * Generates an embed code for the vimeo video 
     * @param  [string] $id the id that needs to be embeded
     * @return [string] the embedable code
     */
    public function embed() {
        return '<iframe frameborder="0" allowfullscreen src="'.$this->getLink().'"></iframe>';
    }

    /**
     * Get the representative link of the current media
     * @return [string] link to the media
     */
    public function getLink() {
        return '//player.vimeo.com/video/'.$this->id;
    }

}