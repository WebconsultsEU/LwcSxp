<?php

namespace LwcBlog;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Static
 *
 * @author John Behrens <John.behrens@WebConsults.eu>
 */
class Slugger {
 
public static function buildSlug($string) {
       
    return self::s9yBuildSlug($string);
    
}
    
 /**
 * Converts a string into a filename that can be used safely in HTTP URLs
 * The S9y SLUGGER is used to create maximum compatibility even if there would be a better way
 * from s9y https://github.com/s9y/Serendipity/blob/master/include/functions_permalinks.inc.php
 *
 * @access public
 * @param   string  input string
 * @param   boolean Shall dots in the filename be removed? (Required for certain regex rules)
 * @return  string  output string
 */
public static function s9yBuildSlug($str, $stripDots = false) {   
     $from = array(
                     ' ',
                     '%',

                     'Ä',
                     'ä',

                     'Ö',
                     'ö',

                     'Ü',
                     'ü',

                     'ß',

                     'é',
                     'è',
                     'ê',

                     'í',
                     'ì',
                     'î',

                     'á',
                     'à',
                     'â',
                     'å',

                     'ó',
                     'ò',
                     'ô',
                     'õ',

                     'ú',
                     'ù',
                     'û',

                     'ç',
                     'Ç',

                     'ñ',

                     'ý');

     $to = array(
                     '-',
                     '%25',

                     'AE',
                     'ae',

                     'OE',
                     'oe',

                     'UE',
                     'ue',

                     'ss',

                     'e',
                     'e',
                     'e',

                     'i',
                     'i',
                     'i',

                     'a',
                     'a',
                     'a',
                     'a',

                     'o',
                     'o',
                     'o',
                     'o',

                     'u',
                     'u',
                     'u',

                     'c',
                     'C',

                     'n',

                     'y');

    // if (isset($GLOBALS['i18n_filename_utf8'])) {
    //Always UTF 8
     
     if(true) {
        $str = str_replace(' ', '_', $str);
        $str = str_replace('&', '%25', $str);
        $str = str_replace('/', '%2F', $str);
        $str = urlencode($str);
        $str = str_replace($from, $to, $str);
    } 
    // Check if dots are allowed
    if ($stripDots) {
        $str = str_replace('.', '', $str);
    }

    // Remove consecutive separators
    $str = preg_replace('#'. $to[0] .'{2,}#s', $to[0], $str);

    // Remove excess separators
    $str = trim($str, $to[0]);
    
    return $str;
}
    
}//class
