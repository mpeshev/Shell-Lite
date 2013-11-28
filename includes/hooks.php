<?php
/**
 * Theme's Action Hooks
 *
 *
 * @file           hooks.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc 
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/includes/hooks.php
 * @link           http://codex.wordpress.org/Plugin_API/Hooks
 * @since          available since Release 1.0
 */
?>
<?php

/**
 * Just after opening <body> tag
 *
 * @see header.php
 */
function shell_container() {
    do_action( 'shell_container' );
}

/**
 * Just after closing </div><!-- end of #container -->
 *
 * @see footer.php
 */
function shell_container_end() {
    do_action( 'shell_container_end' );
}

/**
 * Just after opening <div id="container">
 *
 * @see header.php
 */
function shell_header() {
    do_action( 'shell_header' );
}

/**
 * Just after opening <div id="header">
 *
 * @see header.php
 */
function shell_in_header() {
    do_action( 'shell_in_header' );
}

/**
 * Just after closing </div><!-- end of #header -->
 *
 * @see header.php
 */
function shell_header_end() {
    do_action( 'shell_header_end' );
}

/**
 * Just before opening <div id="wrapper">
 *
 * @see header.php
 */
function shell_wrapper() {
    do_action( 'shell_wrapper' );
}

/**
 * Just after opening <div id="wrapper">
 *
 * @see header.php
 */
function shell_in_wrapper() {
    do_action( 'shell_in_wrapper' );
}

/**
 * Just after closing </div><!-- end of #wrapper -->
 *
 * @see header.php
 */
function shell_wrapper_end() {
    do_action( 'shell_wrapper_end' );
}

/**
 * Just before opening <div id="widgets">
 *
 * @see sidebar.php
 */
function shell_widgets() {
    do_action( 'shell_widgets' );
}

/**
 * Just after closing </div><!-- end of #widgets -->
 *
 * @see sidebar.php
 */
function shell_widgets_end() {
    do_action( 'shell_widgets_end' );
}

?>