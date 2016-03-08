<?php
use PS\MediaParser\MediaParser;

class MediaParserTest extends PHPUnit_Framework_TestCase {

    public function testYoutubeLink() {
        $result = MediaParser::parse('https://www.youtube.com/watch?v=V9Pg4f0v3dg');
        $this->assertEquals('V9Pg4f0v3dg', $result->id);
        $this->assertEquals('youtube', $result->type);
    }

    public function testYoutubeWrongLink() {
        $result = MediaParser::parse('<iframe width="420" height="315" src="https://www.yautube.com/embed/V9Pg4f0v3dg" frameborder="0" allowfullscreen></iframe>');
        $this->assertEquals(false, $result);
    }

    public function testVimeoLink() {
        $result = MediaParser::parse('https://vimeo.com/channels/staffpicks/120125960');
        $this->assertEquals('120125960', $result->id);
        $this->assertEquals('vimeo', $result->type);
    }

}