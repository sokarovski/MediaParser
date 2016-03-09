<?php
use PS\MediaParser\Services\Youtube;

class YoutubeServiceTest extends PHPUnit_Framework_TestCase {

    public function testYoutubeLink() {
        $url = 'https://www.youtube.com/watch?v=V9Pg4f0v3dg';
        $this->testValidity($url, true);
        $this->testParsing($url, 'V9Pg4f0v3dg');
    }

    public function testYoutubeLinkShortened() {
        $url = 'https://youtu.be/V9Pg4f0v3dg';
        $this->testValidity($url, true);
        $this->testParsing($url, 'V9Pg4f0v3dg');
    }

    public function testYoutubeIframeEmbed() {
        $url = '<iframe width="420" height="315" src="https://www.youtube.com/embed/V9Pg4f0v3dg" frameborder="0" allowfullscreen></iframe>';
        $this->testValidity($url, true);
        $this->testParsing($url, 'V9Pg4f0v3dg');
    }

    public function testYoutubeInvalidLink() {
        $url = '<iframe width="420" height="315" src="https://www.mytube.com/embed/V9Pg4f0v3dg" frameborder="0" allowfullscreen></iframe>';
        $this->testValidity($url, false);
    }

    public function testYoutubeLinkInLipsum() {
        $url = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum quam lacus, at dapibus sem pretium id. Nunc ultrices malesuada risus, consectetur luctus est tempor nec. Donec eget mattis ex. Nulla volutpat nisi sed orci tempus, sit amet malesuada dui lacinia. Pellentesque non lectus ac nunc efficitur mollis vel nec metus. Ut sit amet malesuada risus. Pellentesque rhoncus suscipit urna, quis dictum turpis fermentum sit amet. Vivamus a dui justo. https://www.youtube.com/watch?v=V9Pg4f0v3dg Fusce volutpat turpis sed diam ornare, at lobortis ipsum pulvinar. Vestibulum augue odio, volutpat nec maximus vitae, suscipit tincidunt erat. Mauris porta elementum eros, vel finibus lacus feugiat et. Aliquam efficitur enim hendrerit lacus molestie dictum. Phasellus ornare molestie ultricies. Cras lobortis dolor vel lectus viverra, et blandit augue scelerisque. Duis tempus gravida turpis, vitae fermentum neque elementum ut.';
        $this->testValidity($url, true);
        $this->testParsing($url, 'V9Pg4f0v3dg');
    }

    /**
     * @group ignore
     */
    public function testValidity($url, $expected) {
        $this->assertEquals($expected, Youtube::match($url));
    }

    /**
     * @group ignore
     */
    public function testParsing($url, $expected) {
        $youtube = new Youtube($url);
        $this->assertEquals($expected, $youtube->id);
    }

}