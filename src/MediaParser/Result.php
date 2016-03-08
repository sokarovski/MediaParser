<?php 
namespace PS\MediaParser;

class Result {
    
    /**
     * Fully qualified class name that implements MediaParser/Service interface
     * @var [string]
     */
    public $service;

    /**
     * Easily readable string that helps you identify the servie Ex: youtube, vimeo, soundcloud...
     * @var [string]
     */
    public $type;

    /**
     * The id of the media that is parsed
     * @var [string]
     */
    public $id;

    /**
     * Creates a new reference of the Result object
     * @param [string] $service fully qualified class name that implements MediaParser/Service interface
     * @param [string] $id the id of the media that is parsed
     */
    public function __construct($service, $id) {
        $this->service = $service;
        $this->type = $service::serviceIdentifier;
        $this->id = $id;
    }

    /**
     * Helper method that lets you embed the service that was parsed
     * @return [string] the embedable code
     */
    public function embed() {
        if ($this->service && $this->id != '')
            return $this->service::embed($id);

        return '';
    }

}