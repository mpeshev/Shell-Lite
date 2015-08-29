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

/**
 * Site Verification and Webmaster Tools
 * If user sets the code we're going to display meta verification
 * And if left blank let's not display anything at all in case there is a plugin that does this
 */
 
function shell_google_verification() {
    $options = get_option('shell_theme_options');
    if ( !empty( $options['google_site_verification'] ) ) {
		echo '<meta name="google-site-verification" content="' . $options['google_site_verification'] . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_google_verification');

function shell_bing_verification() {
    $options = get_option('shell_theme_options');
    if ( ! empty( $options['bing_site_verification'] ) ) {
        echo '<meta name="msvalidate.01" content="' . $options['bing_site_verification'] . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_bing_verification');

function shell_yahoo_verification() {
    $options = get_option('shell_theme_options');
    if ( ! empty( $options['yahoo_site_verification'] ) ) {
        echo '<meta name="y_key" content="' . $options['yahoo_site_verification'] . '" />' . "\n";
    }
}

add_action('wp_head', 'shell_yahoo_verification');

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
			'sanitize_callback' => 'wp_kses_stripslashes',
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
			'shell_theme_options[home_subheadline]',
			array(
					'sanitize_callback' => 'wp_kses_stripslashes',
					'type' => 'option'
			)
	);
	
	$wp_customize->add_setting(
			'shell_theme_options[home_content_area]',
			array(
					'sanitize_callback' => 'wp_kses_stripslashes',
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
	
	$wp_customize->add_control(
			'shell_theme_options[home_content_area]',
			array(
					'label' => __( 'Content Area', 'shell' ),
					'section' => 'shell_lite_options',
					'type' => 'textarea',
			)
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[featured_image_link]',
	    array(
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'wp_kses_stripslashes',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'wp_filter_post_kses',
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
			'sanitize_callback' => 'wp_filter_post_kses',
            'type' => 'option'
        )
	);
	$wp_customize->add_control(
	    'shell_theme_options[google_site_verification]',
	    array(
			'description' => __( '<strong>This feature is going to be removed in the upcoming version.</strong>', 'shell' ),
	        'label' => __( 'Google Site Verification', 'shell' ),
	        'section' => 'shell_lite_options',
	        'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[bing_site_verification]',
	    array(
			'sanitize_callback' => 'wp_filter_post_kses',
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[bing_site_verification]',
	    array(
			'description' => __( '<strong>This feature is going to be removed in the upcoming version.</strong>', 'shell' ),
			'label' => __( 'Bing Site Verification', 'shell' ),
			'section' => 'shell_lite_options',
			'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[yahoo_site_verification]',
	    array(
			'sanitize_callback' => 'wp_filter_post_kses',
            'type' => 'option'
        )
	);
	
	$wp_customize->add_control(
	    'shell_theme_options[yahoo_site_verification]',
	    array(
			'description' => __( '<strong>This feature is going to be removed in the upcoming version.</strong>', 'shell' ),
			'label' => __( 'Yahoo Site Verification', 'shell' ),
			'section' => 'shell_lite_options',
			'type' => 'text',
	    )
	);
	
	$wp_customize->add_setting(
	    'shell_theme_options[twitter_uid]',
	    array(
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'esc_url_raw',
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
			'sanitize_callback' => 'wp_filter_post_kses',
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
			'sanitize_callback' => 'wp_filter_post_kses',
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
			'sanitize_callback' => 'wp_filter_post_kses',
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
