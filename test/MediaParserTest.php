<?php

class MediaParserTest extends PHPUnit_Framework_TestCase {

    public function testYoutubeLink() {
        $result = \PS\MediaParser::parse('https://www.youtube.com/watch?v=V9Pg4f0v3dg');
        $this->assertEquals('V9Pg4f0v3dg', $result->id);
        $this->assertEquals('youtube', $result->type);
    }

    public function testYoutubeLinkShortened() {
        $result = \PS\MediaParser::parse('https://youtu.be/V9Pg4f0v3dg');
        $this->assertEquals('V9Pg4f0v3dg', $result->id);
        $this->assertEquals('youtube', $result->type);
    }

    public function testYoutubeIframeEmbed() {
        $result = \PS\MediaParser::parse('<iframe width="420" height="315" src="https://www.youtube.com/embed/V9Pg4f0v3dg" frameborder="0" allowfullscreen></iframe>');
        $this->assertEquals('V9Pg4f0v3dg', $result->id);
        $this->assertEquals('youtube', $result->type);
    }

    public function testYoutubeWrongLink() {
        $result = \PS\MediaParser::parse('<iframe width="420" height="315" src="https://www.yautube.com/embed/V9Pg4f0v3dg" frameborder="0" allowfullscreen></iframe>');
        $this->assertEquals(false, $result);
    }

    public function testYoutubeLinkInLipsum() {
        $result = \PS\MediaParser::parse('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum quam lacus, at dapibus sem pretium id. Nunc ultrices malesuada risus, consectetur luctus est tempor nec. Donec eget mattis ex. Nulla volutpat nisi sed orci tempus, sit amet malesuada dui lacinia. Pellentesque non lectus ac nunc efficitur mollis vel nec metus. Ut sit amet malesuada risus. Pellentesque rhoncus suscipit urna, quis dictum turpis fermentum sit amet. Vivamus a dui justo. https://www.youtube.com/watch?v=V9Pg4f0v3dg Fusce volutpat turpis sed diam ornare, at lobortis ipsum pulvinar. Vestibulum augue odio, volutpat nec maximus vitae, suscipit tincidunt erat. Mauris porta elementum eros, vel finibus lacus feugiat et. Aliquam efficitur enim hendrerit lacus molestie dictum. Phasellus ornare molestie ultricies. Cras lobortis dolor vel lectus viverra, et blandit augue scelerisque. Duis tempus gravida turpis, vitae fermentum neque elementum ut.');
        $this->assertEquals('V9Pg4f0v3dg', $result->id);
        $this->assertEquals('youtube', $result->type);
    }

    public function testVimeoLink() {
        $result = \PS\MediaParser::parse('https://vimeo.com/channels/staffpicks/120125960');
        $this->assertEquals('120125960', $result->id);
        $this->assertEquals('vimeo', $result->type);
    }

    public function testVimeoLinkShortened() {
        $result = \PS\MediaParser::parse('https://vimeo.com/31906770');
        $this->assertEquals('31906770', $result->id);
        $this->assertEquals('vimeo', $result->type);
    }

    public function testVimeoLinkWithSlug() {
        $result = \PS\MediaParser::parse('https://vimeo.com/joshuatate/guestroom');
        $this->assertEquals('120125960', $result->id);
        $this->assertEquals('vimeo', $result->type);
    }

    public function testVimeoIframeEmbed() {
        $result = \PS\MediaParser::parse('<iframe src="https://player.vimeo.com/video/120125960?color=f7eb05&title=0&byline=0&portrait=0&badge=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <p><a href="https://vimeo.com/120125960">Guest Room</a> from <a href="https://vimeo.com/joshuatate">Joshua Tate</a> on <a href="https://vimeo.com">Vimeo</a>.</p>');
        $this->assertEquals('120125960', $result->id);
        $this->assertEquals('vimeo', $result->type);
    }

    public function testVimeoLinkInLipsum() {
        $result = \PS\MediaParser::parse('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum quam lacus, at dapibus sem pretium id. Nunc ultrices malesuada risus, consectetur luctus est tempor nec. Donec eget mattis ex. Nulla volutpat nisi sed orci tempus, sit amet malesuada dui lacinia. Pellentesque non lectus ac nunc efficitur mollis vel nec metus. Ut sit amet malesuada risus. Pellentesque rhoncus suscipit urna, quis dictum turpis fermentum sit amet. Vivamus a dui justo. https://vimeo.com/channels/staffpicks/120125960 Fusce volutpat turpis sed diam ornare, at lobortis ipsum pulvinar. Vestibulum augue odio, volutpat nec maximus vitae, suscipit tincidunt erat. Mauris porta elementum eros, vel finibus lacus feugiat et. Aliquam efficitur enim hendrerit lacus molestie dictum. Phasellus ornare molestie ultricies. Cras lobortis dolor vel lectus viverra, et blandit augue scelerisque. Duis tempus gravida turpis, vitae fermentum neque elementum ut.');
        $this->assertEquals('120125960', $result->id);
        $this->assertEquals('vimeo', $result->type);
    }

}