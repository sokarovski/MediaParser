<?php
use PS\MediaParser\Services\Facebook;

class FacebookServiceTest extends PHPUnit_Framework_TestCase {
    
    public function testFacebookLink() {
        $url = 'https://www.facebook.com/tanerius/posts/10154080577757125';
        $this->testValidity($url, true);
        $this->testParsing($url, 'tanerius','10154080577757125');
    }

    public function testFacebookEmbed() {
        $url = '<div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));</script><div class="fb-post" data-href="https://www.facebook.com/tanerius/posts/10154080577757125" data-width="500"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/tanerius/posts/10154080577757125"><p>Petar ako ti najdam vakva ke ti zeam :)</p>Posted by <a href="https://www.facebook.com/tanerius">Taner Selim</a> on&nbsp;<a href="https://www.facebook.com/tanerius/posts/10154080577757125">Sunday, March 6, 2016</a></blockquote></div></div>';
        $this->testValidity($url, true);
        $this->testParsing($url, 'tanerius','10154080577757125');
    }

    public function testFacebookLinkInIpsum() {
        $url = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum quam lacus, at dapibus sem pretium id. Nunc ultrices malesuada risus, consectetur luctus est tempor nec. Donec eget mattis ex. Nulla volutpat nisi sed orci tempus, sit amet malesuada dui lacinia. Pellentesque non lectus ac nunc efficitur mollis vel nec metus. Ut sit amet malesuada risus. Pellentesque rhoncus suscipit urna, quis dictum turpis fermentum sit amet. Vivamus a dui justo. https://www.facebook.com/tanerius/posts/10154080577757125 Fusce volutpat turpis sed diam ornare, at lobortis ipsum pulvinar. Vestibulum augue odio, volutpat nec maximus vitae, suscipit tincidunt erat. Mauris porta elementum eros, vel finibus lacus feugiat et. Aliquam efficitur enim hendrerit lacus molestie dictum. Phasellus ornare molestie ultricies. Cras lobortis dolor vel lectus viverra, et blandit augue scelerisque. Duis tempus gravida turpis, vitae fermentum neque elementum ut.';
        $this->testValidity($url, true);
        $this->testParsing($url, 'tanerius','10154080577757125');
    }

    public function testFacebookInvalidLink() {
        $url = 'https://www.myfacebook.com/tanerius/posts/10154080577757125';
        $this->testValidity($url, false);
    }

    /**
     * @group ignore
     */
    public function testValidity($url, $expected) {
        $this->assertEquals($expected, Facebook::match($url));
    }

    /**
     * @group ignore
     */
    public function testParsing($url, $expectedUsername, $expectedId) {
        $facebook = new Facebook($url);
        $this->assertEquals($expectedUsername, $facebook->getParameter('username'));
        $this->assertEquals($expectedId, $facebook->id);
    }

}