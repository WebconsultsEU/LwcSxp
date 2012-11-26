<?php
/**
 * LwCBlog Configuration 
 *
 * Drop this file into ./config/autoload/ or other autoload dir as configures
 */
$settings = array(
    
        "feedtitle" => "WebConsults.eu Techblog",
        "feedaddress" => "http://www.example.com/blog/feed/rss",
        "feedlink" => "http://www.example.com/blog/feed/atom",
        "feedauthor" => array(
	            'name'  => 'Yoursite',
	            'email' => 'info@example.com',
	            'uri'   => 'http://www.example.com',
	             ),
        "feeddescription" => "Example Website feed",
        "feedsitelink" => 'http://www.example.com/blog',
        );
    

/**
 * You do not need to edit below this line
 */
return array(
    'LwcBlog' => $settings,    
);
