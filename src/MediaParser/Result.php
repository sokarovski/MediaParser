<?php 
namespace PS\MediaParser;

abstract class Result {

    /**
     * The type of the media that is parsed Ex: youtube, vimeo, soundcloud, twitter
     * @var [string]
     */
    static $type = 'unknown';

    /**
     * The id of the media that is parsed
     * @var [string]
     */
    public $id;

    /**
     * A keyed array containing any extra data than the id that needs to be saved for this media
     * @var [array]
     */
    private $extraData;

    /**
     * Creates a new reference of the Result object
     */
    public function __construct($string) {
        $this->parse($string);
    }

    /**
     * Tests to see if a string or URL actualy contains link to a media
     * @param  [string] $string input string that needs to be tested
     * @return [boolean] weather the string contains link to youtube video
     */
    protected function parse($fromString) {
        throw new \Exception("Parser for this media is not implemented yet", 1);
    }

    /**
     * Helper method that lets you embed the service that was parsed
     * @return [string] the embedable code
     */
    public function embed() {
        return "";
    }

    public function setParameter($key, $value) {
        if ($this->extraData == NULL)
            $this->extraData = array();

        $this->extraData[$key] = $value;
    }

    public function getParameter($key) {
        if (isset($this->extraData[$key]))
            return $this->extraData[$key];

        return false;
    }

    public function getParameters() {
        return $this->extraData == NULL ? array() : $this->extraData;
    }

    /**
     * Get the representative link of the current media
     * @return [string] link to the media
     */
    public function getLink() {
        return '';
    }

}