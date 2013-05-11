<?php
/**
 * Version Control
 *
 *
 * @file           version.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc 
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/includes/version.php
 * @link           N/A
 * @since          available since Release 1.0
 */
?>
<?php
if ( function_exists('wp_get_theme')) {
	
function shell_template_data() {
    echo '<!-- We need this for debugging -->' . "\n";
    echo '<meta name="template" content="' . get_shell_template_name() . ' ' . get_shell_template_version() . '" />' . "\n";
}
 
add_action('wp_head', 'shell_template_data');

function shell_theme_data() {
    if ( is_child_theme() ) {
        echo '<meta name="theme" content="' . get_shell_theme_name() . ' ' . get_shell_theme_version() . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_theme_data');

function get_shell_theme_name() {
	$theme = wp_get_theme();
	return $theme->Name;
}

function get_shell_theme_version() {
	$theme = wp_get_theme();
	return $theme->Version;	
}

function get_shell_template_name() {
	$theme = wp_get_theme();
	$parent = $theme->parent();
	if ( $parent )
		$theme = $parent;
	
	return $theme->Name;
}

function get_shell_template_version() {
	$theme = wp_get_theme();
	$parent = $theme->parent();
	if ( $parent )
		$theme = $parent;

	return $theme->Version;	
}

} else {
	
/**
 * < 3.4 Backward Compatibility
 */
	
$theme_data = wp_get_theme(STYLESHEETPATH . '/style.css');
define('shell_current_theme', $theme_name = $theme_data['Name']);

function shell_template_data() {

    $theme_data = wp_get_theme(TEMPLATEPATH . '/style.css');
    $shell_template_name = $theme_data['Name'];
    $shell_template_version = $theme_data['Version'];

    echo '<!-- We need this for debugging -->' . "\n";
    echo '<meta name="template" content="' . $shell_template_name . ' ' . $shell_template_version . '" />' . "\n";
}

add_action('wp_head', 'shell_template_data');

function shell_theme_data() {
    if (is_child_theme()) {
        $theme_data = wp_get_theme(STYLESHEETPATH . '/style.css');
        $shell_theme_name = $theme_data['Name'];
        $shell_theme_version = $theme_data['Version'];

        echo '<meta name="theme" content="' . $shell_theme_name . ' ' . $shell_theme_version . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_theme_data');
}
