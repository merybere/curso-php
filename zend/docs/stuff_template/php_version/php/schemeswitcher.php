<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 *
 * Script for recognizing and changing actual color scheme.
 * Actual color scheme name is held in global variable: $scheme, and actual
 * variant of color scheme (black or white) is held in global variable: $variant.
 */

// -----------------------------------------------------------------------------

// Configuration
$config = array
(
  'default' => 'bright-blue',               // name of the default color scheme
  'cookie_name' => 'stuff_cookie_K2lMe8H6', // name of the cookie with informations about user browser's scheme
  'cookie_time' => 30                       // time (days) from last vistit when remembered choice of color scheme expires
);

// -----------------------------------------------------------------------------

// Available schemes
$schemes = array
(
  'bright-blue',  'bright-gray', 'bright-green', 'bright-pink', 'bright-red', 'bright-yellow',
  'dark-blue', 'dark-green', 'dark-orange', 'dark-pink', 'dark-white', 'dark-yellow'
);

// -----------------------------------------------------------------------------

// Getting and validiating scheme name
if (isset($_GET['scheme']))
{
  $scheme = $_GET['scheme'];
}
else if (isset($_COOKIE[$config['cookie_name']]))
{
  $scheme = $_COOKIE[$config['cookie_name']];
}
else
{
  $scheme = $config['default'];
}
if ( ! in_array($scheme, $schemes))
{
  $scheme = $config['default'];
}
$variant = stripos($scheme, 'bright') === 0 ? 'white' : 'black';

// Remember scheme name
setcookie($config['cookie_name'], $scheme, time()+$config['cookie_time']*86400);