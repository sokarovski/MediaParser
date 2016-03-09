<?php
use PS\MediaParser\Services\Vimeo;

class VimeoServiceTests extends PHPUnit_Framework_TestCase {
    
    public function testVimeoLink() {
        $url = 'https://vimeo.com/channels/staffpicks/120125960';
        $this->testValidity($url, true);
        $this->testParsing($url, '120125960');
    }

    public function testVimeoInvalidLink() {
        $url = 'https://myvimeo.com/channels/staffpicks/120125960';
        $this->testValidity($url, false);
    }

    public function testVimeoLinkShortened() {
        $url = 'https://vimeo.com/31906770';
        $this->testValidity($url, true);
        $this->testParsing($url, '31906770');
    }

    public function testVimeoLinkWithSlug() {
        $url = 'https://vimeo.com/joshuatate/guestroom';
        $this->testValidity($url, true);
        $this->testParsing($url, '120125960');
    }

    public function testVimeoIframeEmbed() {
        $url = '<iframe src="https://player.vimeo.com/video/120125960?color=f7eb05&title=0&byline=0&portrait=0&badge=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <p><a href="https://vimeo.com/120125960">Guest Room</a> from <a href="https://vimeo.com/joshuatate">Joshua Tate</a> on <a href="https://vimeo.com">Vimeo</a>.</p>';
        $this->testValidity($url, true);
        $this->testParsing($url, '120125960');
    }

    public function testVimeoLinkInLipsum() {
        $url = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum quam lacus, at dapibus sem pretium id. Nunc ultrices malesuada risus, consectetur luctus est tempor nec. Donec eget mattis ex. Nulla volutpat nisi sed orci tempus, sit amet malesuada dui lacinia. Pellentesque non lectus ac nunc efficitur mollis vel nec metus. Ut sit amet malesuada risus. Pellentesque rhoncus suscipit urna, quis dictum turpis fermentum sit amet. Vivamus a dui justo. https://vimeo.com/channels/staffpicks/120125960 Fusce volutpat turpis sed diam ornare, at lobortis ipsum pulvinar. Vestibulum augue odio, volutpat nec maximus vitae, suscipit tincidunt erat. Mauris porta elementum eros, vel finibus lacus feugiat et. Aliquam efficitur enim hendrerit lacus molestie dictum. Phasellus ornare molestie ultricies. Cras lobortis dolor vel lectus viverra, et blandit augue scelerisque. Duis tempus gravida turpis, vitae fermentum neque elementum ut.';
        $this->testValidity($url, true);
        $this->testParsing($url, '120125960');
    }

    /**
     * @group ignore
     */
    public function testValidity($url, $expected) {
        $this->assertEquals($expected, Vimeo::match($url));
    }

    /**
     * @group ignore
     */
    public function testParsing($url, $expected) {
        $vimeo = new Vimeo($url);
        $this->assertEquals($expected, $vimeo->id);
    }

}