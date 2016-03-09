# MediaParser

PHP MediaParser that parses media string and urls and extracts id so they can be easily stored in database and re-embeded

## Requirements

- PHP >=5.4

## Supported media and services

- Youtube (videos)
- Vimeo (videos)
- Twitter (tweet)
- Facebook (post)

## Code Examples

```php

use PS\MediaParser\MediaParser;

// parse a youtube link
$result = MediaParser::parse('https://www.youtube.com/watch?v=V9Pg4f0v3dg');
echo $result->id; //V9Pg4f0v3dg
echo $result->type; //youtube

// parse vimeo link in text
$result = MediaParser::parse('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum quam lacus, at dapibus sem pretium id. Nunc ultrices malesuada risus, consectetur luctus est tempor nec. Donec eget mattis ex. Nulla volutpat nisi sed orci tempus, sit amet malesuada dui lacinia. Pellentesque non lectus ac nunc efficitur mollis vel nec metus. Ut sit amet malesuada risus. Pellentesque rhoncus suscipit urna, quis dictum turpis fermentum sit amet. Vivamus a dui justo. https://vimeo.com/channels/staffpicks/120125960 Fusce volutpat turpis sed diam ornare, at lobortis ipsum pulvinar. Vestibulum augue odio, volutpat nec maximus vitae, suscipit tincidunt erat. Mauris porta elementum eros, vel finibus lacus feugiat et. Aliquam efficitur enim hendrerit lacus molestie dictum. Phasellus ornare molestie ultricies. Cras lobortis dolor vel lectus viverra, et blandit augue scelerisque. Duis tempus gravida turpis, vitae fermentum neque elementum ut.');
echo $result->id; //120125960
echo $result->type; //vimeo

// parse youtube embed code
$result = MediaParser::parse('<iframe width="420" height="315" src="https://www.youtube.com/embed/V9Pg4f0v3dg" frameborder="0" allowfullscreen></iframe>');
echo $result->id; //V9Pg4f0v3dg
echo $result->type; //youtube
```

```php

use PS\MediaParser\Services\Youtube;

// check youtube link validity
Youtube::match('hello world this is a youtube link https://www.youtube.com/watch?v=V9Pg4f0v3dg'); //true
Youtube::match('hello world this is NOT a youtube link https://www.mytube.com/watch?v=V9Pg4f0v3dg'); //false

```

```php

use PS\MediaParser\MediaParser;

// embed youtube video
$result = MediaParser::parse('https://www.youtube.com/watch?v=V9Pg4f0v3dg');
echo $result->embed(); //<iframe frameborder="0" allowfullscreen src="//www.youtube.com/embed/V9Pg4f0v3dg"></iframe>

```

```php

use PS\MediaParser\MediaParser;

// embed facebook post
$result = MediaParser::parse('https://www.facebook.com/tanerius/posts/10154080577757125');
echo $result->embed(); //will print out HTML to embed the post in your page

```


## License

MediaParser is licensed under the [MIT License](http://opensource.org/licenses/MIT).

Copyright 2016 [Petar Sokarovski](http://github.com/sokarovski)