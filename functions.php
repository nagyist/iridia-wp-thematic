<?php

// Getting Theme and Child Theme Data
// Credits: Joern Kretzschmar

$themeData = get_theme_data(TEMPLATEPATH . '/style.css');
$thm_version = trim($themeData['Version']);
if(!$thm_version)
    $thm_version = "unknown";

$ct=get_theme_data(STYLESHEETPATH . '/style.css');
$templateversion = trim($ct['Version']);
if(!$templateversion)
    $templateversion = "unknown";

// set theme constants
define('THEMENAME', $themeData['Title']);
define('THEMEAUTHOR', $themeData['Author']);
define('THEMEURI', $themeData['URI']);
define('THEMATICVERSION', $thm_version);

// set child theme constants
define('TEMPLATENAME', $ct['Title']);
define('TEMPLATEAUTHOR', $ct['Author']);
define('TEMPLATEURI', $ct['URI']);
define('TEMPLATEVERSION', $templateversion);

// Check for WordPress mu or WordPress 3.0
define('THEMATIC_MB', function_exists('get_blog_option'));

// Check for WordPress 3.0 add_theme_support()
if (function_exists('wp_login_form')) {
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
}

// load jQuery
wp_enqueue_script('jquery');

// Path constants
define('THEMELIB', TEMPLATEPATH . '/library');

// Create Theme Options Page
require_once(THEMELIB . '/extensions/theme-options.php');

// Load legacy functions
require_once(THEMELIB . '/legacy/deprecated.php');

// Load widgets
require_once(THEMELIB . '/extensions/widgets.php');

// Load custom header extensions
require_once(THEMELIB . '/extensions/header-extensions.php');

// Load custom content filters
require_once(THEMELIB . '/extensions/content-extensions.php');

// Load custom Comments filters
require_once(THEMELIB . '/extensions/comments-extensions.php');
 
// Load custom discussion filters
require_once(THEMELIB . '/extensions/discussion-extensions.php');

// Load custom Widgets
require_once(THEMELIB . '/extensions/widgets-extensions.php');

// Load the Comments Template functions and callbacks
require_once(THEMELIB . '/extensions/discussion.php');

// Load custom sidebar hooks
require_once(THEMELIB . '/extensions/sidebar-extensions.php');

// Load custom footer hooks
require_once(THEMELIB . '/extensions/footer-extensions.php');

// Add Dynamic Contextual Semantic Classes
require_once(THEMELIB . '/extensions/dynamic-classes.php');

// Need a little help from our helper functions
require_once(THEMELIB . '/extensions/helpers.php');

// Load shortcodes
require_once(THEMELIB . '/extensions/shortcodes.php');

// Adds filters for the description/meta content in archives.php
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remove the WordPress Generator – via http://blog.ftwr.co.uk/archives/2007/10/06/improving-the-wordpress-generator/
function thematic_remove_generators() { return ''; }
if (apply_filters('thematic_hide_generators', TRUE)) {  
    add_filter('the_generator','thematic_remove_generators');
}

// Translate, if applicable
load_theme_textdomain('thematic', THEMELIB . '/languages');

$locale = get_locale();
$locale_file = THEMELIB . "/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);


?>