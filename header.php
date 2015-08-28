<?php
/**
 * Theme's Header
 *
 *
 * @file       	   header.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
if ( is_singular() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script('comment-reply');
}
	
wp_head();
?>
</head>

<body <?php body_class(); ?>>
        
<?php shell_container(); // before container hook ?>
<div id="container" class="hfeed">

    <?php shell_header(); // before header hook ?>
    <div id="header">
    <?php shell_in_header(); // header hook ?>
   
	<?php if ( get_header_image() != '' ) : ?>
               
        <div id="logo">
            <a href="<?php echo home_url( '/' ); ?>">
            	<img src="<?php header_image(); ?>" width="<?php if ( function_exists( 'get_custom_header' ) ) { echo get_custom_header() -> width; } else { echo HEADER_IMAGE_WIDTH; } ?>" height="<?php if ( function_exists( 'get_custom_header' ) ) { echo get_custom_header() -> height; } else { echo HEADER_IMAGE_HEIGHT; } ?>" alt="<?php bloginfo( 'name' ); ?>" />
            </a>
        </div><!-- end of #logo -->
        
    <?php endif; // header image was removed ?>

    <?php if ( ! get_header_image() ) : ?>
                
        <div id="logo">
            <h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <p class="description"><?php bloginfo( 'description' ); ?></p>
        </div><!-- end of #logo -->  

    <?php endif; // header image was removed (again) ?>

        <div id="search-box">
            <?php get_search_form(); ?>
        </div><!-- end of #search-box -->
        
        <?php
        /**
         * WPML Language Switcher
         */
		if ( has_action( 'icl_language_selector' ) ) {
			echo '<div id="wpml-language-selector">';
				do_action( 'icl_language_selector' );
			echo '</div><!-- end of #wpml-language-selector -->';
		} 
        ?>
                
        <?php
            $options = get_option( 'shell_theme_options' );
					
            // First let's check if any of this was set
		
                echo '<ul class="social-icons">';
					
	                if ( ! empty( $options['twitter_uid'] ) ) {
	                	echo '<li class="twitter-icon"><a href="' . $options['twitter_uid'] . '" target="_blank">'
	                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/twitter-icon-small.png" alt="Twitter">'
	                    .'</a></li>';
	                }
	
	                if ( ! empty( $options['facebook_uid'] ) ) {
	                	echo '<li class="facebook-icon"><a href="' . $options['facebook_uid'] . '" target="_blank">'
	                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/facebook-icon-small.png" alt="Facebook">'
	                    .'</a></li>';
	                }
	                
	                if ( ! empty( $options['wordpress_uid'] ) ) {
	                	echo '<li class="wordpress-icon"><a href="' . $options['wordpress_uid'] . '" target="_blank">'
	                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/wordpress-icon-small.png" alt="WordPress">'
	                    .'</a></li>';
	                }
	                
	                if ( ! empty( $options['github_uid'] ) ) {
	                	echo '<li class="github-icon"><a href="' . $options['github_uid'] . '" target="_blank">'
	                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/github-icon-small.png" alt="GitHub">'
	                    .'</a></li>';
	                }
	  
	                if ( ! empty( $options['linkedin_uid'] ) ) {
	                	echo '<li class="linkedin-icon"><a href="' . $options['linkedin_uid'] . '" target="_blank">'
	                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/linkedin-icon-small.png" alt="LinkedIn">'
	                    .'</a></li>';
	                }
	                    
					if ( ! empty( $options['youtube_uid'] ) ) {
						echo '<li class="youtube-icon"><a href="' . $options['youtube_uid'] . '" target="_blank">'
	                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/youtube-icon-small.png" alt="YouTube">'
	                    .'</a></li>';
					}
	       
	                if ( ! empty( $options['rss_feed'] ) ) {
	                	echo '<li class="rss-icon"><a href="' . $options['rss_feed'] . '" target="_blank">'
	                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/rss-icon-small.png" alt="RSS">'
	                    .'</a></li>';
	                }
                    
                echo '</ul><!-- end of .social-icons -->';
        ?>
                
            <?php if ( has_nav_menu( 'primary', 'shell' ) ) { ?>
            
			    <?php wp_nav_menu( array(
				    	'container'      => '', 
						'menu_class'     => 'menu', 
						'theme_location' => 'primary')
					); 
				?>
                
				<?php } else { ?>

	                <ul class="menu">
	                    <li><a href="<?php echo home_url(); ?>/"><?php _e( 'Home', 'shell' );?></a></li>
	                    <?php wp_list_pages( 'title_li=' ); ?>
	                </ul><!-- end of .menu -->
                
				<?php } ?>
 
    </div><!-- end of #header -->
    <?php shell_header_end(); // after header hook ?>
    
	<?php shell_wrapper(); // before wrapper ?>
    <div id="wrapper" class="clearfix">
    <?php shell_in_wrapper(); // wrapper hook ?>