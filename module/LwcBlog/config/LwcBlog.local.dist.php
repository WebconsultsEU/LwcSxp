<?php
/**
 * LwCBlog Configuration 
 *
 * Drop this file into ./config/autoload/ or other autoload dir as configures
 */
$settings = array(
    
        "feedtitle" => "WebConsults.eu Techblog",
        "feedaddress" => "http://www.webconsults.eu/blog/feed/rss",
        "feedlink" => "http://www.webconsults.eu/blog/feed/atom",
        "feedauthor" => array(
	            'name'  => 'WebConsults.eu',
	            'email' => 'info@webconsults.eu',
	            'uri'   => 'http://www.webconsults.eu',
	             ),
        "feeddescription" => "WebConsults.eu Techblog",
        "feedsitelink" => 'http://www.webconsults.eu/blog',
        );
    

/**
 * You do not need to edit below this line
 */
return array(
    'LwcBlog' => $settings,    
);
