<?php
/**
 * Customizer Options
 *
 *
 * @file           customizer-options.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc 
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.9.0
 * @filesource     wp-content/themes/shell-lite/includes/customizer-options.php
 * @link           http://themeshaper.com/2010/06/03/sample-theme-options/
 * @since          available since Release 1.9.0
 */

add_action( 'admin_init', 'shell_theme_options_init' );
/**
 * Init plugin options to white list our options
 */
function shell_theme_options_init() {
    register_setting( 'shell_options', 'shell_theme_options', 'shell_theme_options_validate' );
}


/**
 * Site Verification and Webmaster Tools
 * If user sets the code we're going to display meta verification
 * And if left blank let's not display anything at all in case there is a plugin that does this
 */
 
function shell_google_verification() {
    $options = get_option('shell_theme_options');
    if ($options['google_site_verification']) {
	echo '<meta name="google-site-verification" content="' . $options['google_site_verification'] . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_google_verification');

function shell_bing_verification() {
    $options = get_option('shell_theme_options');
    if ($options['bing_site_verification']) {
        echo '<meta name="msvalidate.01" content="' . $options['bing_site_verification'] . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_bing_verification');

function shell_yahoo_verification() {
    $options = get_option('shell_theme_options');
    if ($options['yahoo_site_verification']) {
        echo '<meta name="y_key" content="' . $options['yahoo_site_verification'] . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_yahoo_verification');

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function shell_theme_options_validate( $input ) {

    $input['home_headline'] = wp_kses_stripslashes( $input['home_headline'] );
    $input['home_content_area'] = wp_kses_stripslashes( $input['home_content_area'] );
    $input['home_subheadline'] = wp_kses_stripslashes( $input['home_subheadline'] );
    $input['featured_button_text'] = wp_kses_stripslashes( $input['featured_button_text'] );
    $input['featured_button_link'] = esc_url_raw( $input['featured_button_link'] );
    $input['featured_image'] = esc_url_raw( $input['featured_image'] );
    if ( isset( $input['featured_button_link_target'] ) ) {
    	$input['featured_button_link_target'] = wp_filter_post_kses( $input['featured_button_link_target'] );
    }
    if ( isset( $input['featured_button_hide'] ) ) {
    	$input['featured_button_hide'] = wp_filter_post_kses( $input['featured_button_hide'] );
    } else {
    	$input['featured_button_hide'] = false;
    }
    $input['google_site_verification'] = wp_filter_post_kses( $input['google_site_verification'] );
    $input['bing_site_verification'] = wp_filter_post_kses( $input['bing_site_verification'] );
    $input['yahoo_site_verification'] = wp_filter_post_kses( $input['yahoo_site_verification'] );
    $input['twitter_uid'] = esc_url_raw( $input['twitter_uid'] );
    $input['facebook_uid'] = esc_url_raw( $input['facebook_uid'] );
    $input['wordpress_uid'] = esc_url_raw( $input['wordpress_uid'] );
    $input['github_uid'] = esc_url_raw( $input['github_uid'] );
    $input['linkedin_uid'] = esc_url_raw( $input['linkedin_uid'] );
    $input['youtube_uid'] = esc_url_raw( $input['youtube_uid'] );
    $input['rss_feed'] = esc_url_raw( $input['rss_feed'] );
    if ( isset( $input['breadcrumbs'] ) ) {
	$input['breadcrumbs'] = wp_filter_post_kses( $input['breadcrumbs'] );	
    }
    if ( isset( $input['author_bio'] ) ) {
	$input['author_bio'] = wp_filter_post_kses( $input['author_bio'] );
    }
    if ( isset( $input['show_post_featured_image'] ) ) {
	$input['show_post_featured_image'] = wp_filter_post_kses( $input['show_post_featured_image'] );
    }
	
    return $input;
}

/**
 * Add Shell Lite Theme Options in Customizer.
 */
function shell_customizer_options( $wp_customize ) {
	
    $wp_customize->add_section(
        'shell_lite_options',
        array(
            'title' => __( 'Shell Lite Options', 'shell' ),
            'description' => __( 'Shell Lite Theme Options', 'shell' ),
            'priority' => 500,
        )
    );
    
    $wp_customize->add_setting(
	    'shell_theme_options[home_headline]',
	    array(
            'type' => 'option'
        )
    );
	
	$wp_customize->add_control(
	    'shell_theme_options[home_headline]',
	    array(
	        'label' => __( 'Headline', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[home_content_area]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[home_content_area]',
	    array(
	        'label' => __( 'Content Area', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'textarea',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[home_subheadline]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[home_subheadline]',
	    array(
	        'label' => __( 'Subheadline', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[featured_image_link]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
		$wp_customize, 
		'shell_theme_options[featured_image_link]', 
		array(
			'label'	=> __( 'Featured Image', 'shell' ),
			'section' => 'shell_lite_options',
			'settings' => 'shell_theme_options[featured_image_link]',
		) ) 
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[featured_button_link]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[featured_button_link]',
	    array(
	        'label' => __( 'Featured Button (Link)', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[featured_button_text]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[featured_button_text]',
	    array(
	        'label' => __( 'Featured Button (Text)', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[featured_button_link_target]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[featured_button_link_target]',
	    array(
	        'label' => __( 'Featured Button (Target _blank)?', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'checkbox',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[featured_button_hide]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[featured_button_hide]',
	    array(
	        'label' => __( 'Hide Featured Button', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'checkbox',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[google_site_verification]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[google_site_verification]',
	    array(
	        'label' => __( 'Google Site Verification', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[bing_site_verification]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[bing_site_verification]',
	    array(
	        'label' => __( 'Bing Site Verification', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[yahoo_site_verification]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[yahoo_site_verification]',
	    array(
	        'label' => __( 'Yahoo Site Verification', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[twitter_uid]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[twitter_uid]',
	    array(
	        'label' => __( 'Twitter', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[facebook_uid]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[facebook_uid]',
	    array(
	        'label' => __( 'Facebook', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[wordpress_uid]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[wordpress_uid]',
	    array(
	        'label' => __( 'WordPress', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[github_uid]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[github_uid]',
	    array(
	        'label' => __( 'GitHub', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[linkedin_uid]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[linkedin_uid]',
	    array(
	        'label' => __( 'LinkedIn', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[youtube_uid]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[youtube_uid]',
	    array(
	        'label' => __( 'YouTube', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[rss_feed]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[rss_feed]',
	    array(
	        'label' => __( 'RSS Feed', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[breadcrumbs]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[breadcrumbs]',
	    array(
	        'label' => __( 'Hide Breadcrumbs?', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'checkbox',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[author_bio]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[author_bio]',
	    array(
	        'label' => __( 'Hide Author Bio in single post?', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'checkbox',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[show_post_featured_image]',
	    array(
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[show_post_featured_image]',
	    array(
	        'label' => __( 'Show Featured Image in single post?', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'checkbox',
	    )
	);
}
add_action( 'customize_register', 'shell_customizer_options' );
?>
