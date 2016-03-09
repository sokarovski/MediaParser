<?php
use PS\MediaParser\Services\Twitter;

class TwitterServiceTest extends PHPUnit_Framework_TestCase {
    
    public function testTwitterLink() {
        $url = 'https://twitter.com/iamdevloper/status/692281023841845248';
        $this->testValidity($url, true);
        $this->testParsing($url, 'iamdevloper','692281023841845248');
    }

    public function testTwitterEmbed() {
        $url = '<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">my colleague is building a js app with no framework, no build tool, no compilers…like some sort of psychopath</p>&mdash; I Am Devloper (@iamdevloper) <a href="https://twitter.com/iamdevloper/status/692281023841845248">January 27, 2016</a></blockquote> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
        $this->testValidity($url, true);
        $this->testParsing($url, 'iamdevloper','692281023841845248');
    }

    public function testTwitterLinkInIpsum() {
        $url = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum quam lacus, at dapibus sem pretium id. Nunc ultrices malesuada risus, consectetur luctus est tempor nec. Donec eget mattis ex. Nulla volutpat nisi sed orci tempus, sit amet malesuada dui lacinia. Pellentesque non lectus ac nunc efficitur mollis vel nec metus. Ut sit amet malesuada risus. Pellentesque rhoncus suscipit urna, quis dictum turpis fermentum sit amet. Vivamus a dui justo. https://twitter.com/iamdevloper/status/692281023841845248 Fusce volutpat turpis sed diam ornare, at lobortis ipsum pulvinar. Vestibulum augue odio, volutpat nec maximus vitae, suscipit tincidunt erat. Mauris porta elementum eros, vel finibus lacus feugiat et. Aliquam efficitur enim hendrerit lacus molestie dictum. Phasellus ornare molestie ultricies. Cras lobortis dolor vel lectus viverra, et blandit augue scelerisque. Duis tempus gravida turpis, vitae fermentum neque elementum ut.';
        $this->testValidity($url, true);
        $this->testParsing($url, 'iamdevloper','692281023841845248');
    }

    public function testTwitterInvalidLink() {
        $url = 'https://mytwitter.com/iamdevloper/status/692281023841845248';
        $this->testValidity($url, false);
    }

    /**
     * @group ignore
     */
    public function testValidity($url, $expected) {
        $this->assertEquals($expected, Twitter::match($url));
    }

    /**
     * @group ignore
     */
    public function testParsing($url, $expectedUsername, $expectedId) {
        $twitter = new Twitter($url);
        $this->assertEquals($expectedUsername, $twitter->getParameter('username'));
        $this->assertEquals($expectedId, $twitter->id);
    }

}