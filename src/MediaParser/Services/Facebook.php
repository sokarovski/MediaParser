<?php 
namespace PS\MediaParser\Services;

use PS\MediaParser\ServiceContract;
use PS\MediaParser\Result;

class Facebook extends Result implements ServiceContract {

    static $type = "facebook";

    /**
     * Tests to see if a string or URL actualy contains link to a facebook post
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to facebook post or not
     */
    static function match($string) {
        return preg_match('/\/(www\.)?facebook\.com\/[a-zA-Z0-9\.]{4,15}\/posts\/\d+/i', $string);
    }

    /**
     * Parses a string into a result
     * @param  [string] $fromString input string that needs to be tested
     * @return [boolean] weather parsing was succesfull or not
     */
    protected function parse($fromString) {
        $matches = array();
        if (preg_match('/\/(www\.)?facebook\.com\/([a-zA-Z0-9\.]{4,15})\/posts\/(\d+)/i', $fromString, $matches)) {
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
        $link = $this->getLink();
        return '<div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));</script><div class="fb-post" data-href="'.$link.'" data-width="500"><div class="fb-xfbml-parse-ignore"><blockquote cite="'.$link.'"><p></p> <a href="https://www.facebook.com/'.$this->getParameter('username').'"></a> on&nbsp;<a href="'.$link.'"></a></blockquote></div></div>';
    }

    /**
     * Get the representative link of the current media
     * @return [string] link to the media
     */
    public function getLink() {
        return 'https://www.facebook.com/'.$this->getParameter('username').'/posts/'.$this->id;
    }

}