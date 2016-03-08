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
        return preg_match('/http(s)?:\/\/(player.)?vimeo\.com/i', $string);
    }

    /**
     * Returns vimeo video id from a given string. The string can be either url or iframe embed. 
     * @param  [string] $fromString input string that needs to be tested
     * @return [string|boolean] false if the id cannot be found or the id itself
     */
    static function parse($fromString) {
        $isSluged = preg_match('/vimeo\.com\/(?!channels\/|video\/)[a-z0-9\-\_]+\/[a-z0-9\-\_]+( |$|"){1}/i', $fromString);
        if ($isSluged) {
            $fromString = self::followFinalUrl($fromString);
            if (!preg_match('/vimeo\.com\/(video\/)?[0-9]+/i', $fromString) )
                return false;
        }

        $matches = array();
        if (preg_match('/vimeo\.com\/(video\/|channels\/[a-z0-9\-\_]+\/)?(\d+)/i', $fromString, $matches)) 
            return $matches[2];
        
        return false;
    }

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
    static function embed($id) {
        return '<iframe frameborder="0" allowfullscreen src="//player.vimeo.com/video/'.$this->id.'"></iframe>';
    }

}