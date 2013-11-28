<?php
/**
 * Theme Options
 *
 *
 * @file           theme-options.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc 
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/shell-lite/includes/theme-options.php
 * @link           http://themeshaper.com/2010/06/03/sample-theme-options/
 * @since          available since Release 1.0
 */
?>
<?php
add_action( 'admin_init', 'shell_theme_options_init' );
add_action( 'admin_menu', 'shell_theme_options_add_page' );


/**
 * Init plugin options to white list our options
 */
function shell_theme_options_init() {
    register_setting( 'shell_options', 'shell_theme_options', 'shell_theme_options_validate' );
}

/**
 * Load up the menu page
 */
function shell_theme_options_add_page() {
    add_theme_page( __( 'Theme Options', 'shell' ), __( 'Shell Lite Options', 'shell' ), 'edit_theme_options', 'theme_options', 'shell_theme_options_do_page' );
}

/**
 * Redirect users to Theme Options after activation
 */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == "themes.php" )
	wp_redirect( 'themes.php?page=theme_options' );

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
 * Create the options page
 */
function shell_theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
    
    <div class="wrap">
        <?php
        /**
         * < 3.4 Backward Compatibility
         */
        ?>
        
        <?php 
        $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : wp_get_theme();
        $shell_lite_support_url = 'http://premiumwpsupport.com/forums/forum/products/shell-lite-theme/';
        $shell_lite_child_themes_url = 'http://premiumwpsupport.com/downloads/category/wp-themes/shell-lite-child-themes/'; 
        ?>
        
        <div id="shell-lite-theme-options-header">
        	<?php screen_icon(); echo "<h2>" . $theme_name ." ". __( 'Theme Options', 'shell' ) . "</h2>"; ?>
        </div>
		
		<?php 
		$shell_dismissed = get_option( 'shell_lite_dismiss_notice', false );
		
		if( ! $shell_dismissed ) { // Hide Shell Lite Notice
		?>
			<div id="setting-error-tgmpa" class="updated settings-error shell-lite-theme-notice">
				<a id="shell-lite-notice-dismiss" href="javascript:void();"><?php _e( 'Dismiss this message', 'shell' );?></a>
				<h4>Thank you for downloading Shell Lite Theme.</h4>
				<p>
				 If you have any questions or need support, please visit our <a href="<?php echo $shell_lite_support_url; ?>" target="_blank">Support Forum</a>.
				</p>
				<p>
				If you want to see some Child Themes for Shell Lite, feel free to check those <a href="<?php echo $shell_lite_child_themes_url; ?>" target="_blank">available themes</a>
				</p>
			</div>
		<?php } // End of Hide Shell Lite Notice ?>
		
		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div id="message" class="updated fade shell-lite-options-updated">
				<p>
					<strong><?php _e( 'Shell Lite Options saved', 'shell' ); ?></strong>
				</p>
			</div>
		<?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields( 'shell_options' ); ?>
            <?php $options = get_option( 'shell_theme_options' ); ?>

            <table class="form-table">

                <?php
                /**
                 * Homepage Headline
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Headline', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[home_headline]" class="regular-text" type="text" name="shell_theme_options[home_headline]" value="<?php esc_attr_e( $options['home_headline'] ); ?>" />
                        <label class="description" for="shell_theme_options[home_headline]"><?php _e( 'Enter your headline', 'shell' ); ?></label>
                    </td>
                </tr>

                <?php
                /**
                 * Homepage Content Area
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Content Area', 'shell' ); ?></th>
                    <td>
                        <textarea id="shell_theme_options[home_content_area]" class="large-text" cols="50" rows="10" name="shell_theme_options[home_content_area]"><?php echo esc_textarea( $options['home_content_area'] ); ?></textarea>
                        <label class="description" for="shell_theme_options[home_content_area]"><?php _e( 'Enter your content', 'shell' ); ?></label>
                    </td>
                </tr>

                <?php
                /**
                 * Homepage Subheadline
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Subheadline', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[home_subheadline]" class="regular-text" type="text" name="shell_theme_options[home_subheadline]" value="<?php esc_attr_e( $options['home_subheadline'] ); ?>" />
                        <label class="description" for="shell_theme_options[home_subheadline]"><?php _e( 'Enter your subheadline', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <?php
                /**
                 * Homepage Featured Image
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Featured Image', 'shell' ); ?></th>
	                <td>
					    <input id="shell_theme_options[featured_image]" class="regular-text" type="text" size="36" name="shell_theme_options[featured_image]" value="<?php esc_attr_e( $options['featured_image'] ); ?>" />
					    <label class="description" for="shell_theme_options[featured_image]"><?php _e( 'Enter your featured image link (Suggested image dimensions are <strong>440x300px</strong>.)', 'shell' ); ?></label>
					    <br />
					    <input id="featured_image_upload_button" class="button" type="button" value="Upload Image" />
	                </td>
                </tr>
                <?php
                /**
                 * Homepage Featured Button Link
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Featured Button (Link)', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[featured_button_link]" class="regular-text" type="text" name="shell_theme_options[featured_button_link]" value="<?php esc_attr_e( $options['featured_button_link'] ); ?>" />
                        <label class="description" for="shell_theme_options[featured_button_link]"><?php _e( 'Enter your featured button link', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <?php
                /**
                 * Homepage Featured Button Text
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Featured Button (Text)', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[featured_button_text]" class="regular-text" type="text" name="shell_theme_options[featured_button_text]" value="<?php esc_attr_e( $options['featured_button_text'] ); ?>" />
                        <label class="description" for="shell_theme_options[featured_button_text]"><?php _e( 'Enter your featured button text', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <?php 
                /**
                 * Homepage Featured Button Link Target
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Featured Button (Target)', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[featured_button_link_target]" class="regular-text" type="checkbox" name="shell_theme_options[featured_button_link_target]" value="true" <?php if ( isset( $options['featured_button_link_target'] ) && $options['featured_button_link_target'] == 'true' ) { echo 'checked="checked"'; } ?> /> 
                        <label class="description" for="shell_theme_options[featured_button_link_target]"><?php _e( 'Featured Button Open in New Tab/Window', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <?php 
                /**
                 * Homepage Featured Button Hide
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Hide Featured Button', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[featured_button_hide]" class="regular-text" type="checkbox" name="shell_theme_options[featured_button_hide]" value="true" <?php if ( isset( $options['featured_button_hide'] ) && $options['featured_button_hide'] == 'true' ) { echo 'checked="checked"'; } ?> /> 
                        <label class="description" for="shell_theme_options[featured_button_hide]"><?php _e( 'Hide Featured Button', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <?php
                /**
                 * Google Site Verification
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e('Google Site Verification', 'shell'); ?></th>
                    <td>
                        <input id="shell_theme_options[google_site_verification]" class="regular-text" type="text" name="shell_theme_options[google_site_verification]" value="<?php esc_attr_e($options['google_site_verification']); ?>" />
                        <label class="description" for="shell_theme_options[google_site_verification]"><?php _e('Enter your Google ID number only', 'shell'); ?></label>
                    </td>
                </tr>
                
                <?php
                /**
                 * Bing Site Verification
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e('Bing Site Verification', 'shell'); ?></th>
                    <td>
                        <input id="shell_theme_options[bing_site_verification]" class="regular-text" type="text" name="shell_theme_options[bing_site_verification]" value="<?php esc_attr_e($options['bing_site_verification']); ?>" />
                        <label class="description" for="shell_theme_options[bing_site_verification]"><?php _e('Enter your Bing ID number only', 'shell'); ?></label>
                    </td>
                </tr>
                
                <?php
                /**
                 * Yahoo Site Verification
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e('Yahoo Site Verification', 'shell'); ?></th>
                    <td>
                        <input id="shell_theme_options[yahoo_site_verification]" class="regular-text" type="text" name="shell_theme_options[yahoo_site_verification]" value="<?php esc_attr_e($options['yahoo_site_verification']); ?>" />
                        <label class="description" for="shell_theme_options[yahoo_site_verification]"><?php _e('Enter your Yahoo ID number only', 'shell'); ?></label>
                    </td>
                </tr>
                
                <?php
                /**
                 * Social Media
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Twitter', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[twitter_uid]" class="regular-text" type="text" name="shell_theme_options[twitter_uid]" value="<?php esc_attr_e( $options['twitter_uid'] ); ?>" /> 
                        <label class="description" for="shell_theme_options[twitter_uid]"><?php _e( 'Enter your Twitter URL', 'shell' ); ?></label>
                    </td>
                </tr>

                <tr valign="top"><th scope="row"><?php _e( 'Facebook', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[facebook_uid]" class="regular-text" type="text" name="shell_theme_options[facebook_uid]" value="<?php esc_attr_e( $options['facebook_uid'] ); ?>" /> 
                        <label class="description" for="shell_theme_options[facebook_uid]"><?php _e( 'Enter your Facebook URL', 'shell' ); ?></label>
                    </td>
                </tr>
                
                 <tr valign="top"><th scope="row"><?php _e( 'WordPress', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[wordpress_uid]" class="regular-text" type="text" name="shell_theme_options[wordpress_uid]" value="<?php esc_attr_e( $options['wordpress_uid'] ); ?>" /> 
                        <label class="description" for="shell_theme_options[wordpress_uid]"><?php _e( 'Enter your Facebook URL', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e( 'GitHub', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[github_uid]" class="regular-text" type="text" name="shell_theme_options[github_uid]" value="<?php esc_attr_e( $options['github_uid'] ); ?>" /> 
                        <label class="description" for="shell_theme_options[github_uid]"><?php _e( 'Enter your Facebook URL', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e( 'LinkedIn', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[linkedin_uid]" class="regular-text" type="text" name="shell_theme_options[linkedin_uid]" value="<?php esc_attr_e( $options['linkedin_uid'] ); ?>" /> 
                        <label class="description" for="shell_theme_options[linkedin_uid]"><?php _e( 'Enter your LinkedIn URL', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e( 'YouTube', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[youtube_uid]" class="regular-text" type="text" name="shell_theme_options[youtube_uid]" value="<?php esc_attr_e( $options['youtube_uid'] ); ?>" /> 
                        <label class="description" for="shell_theme_options[youtube_uid]"><?php _e( 'Enter your YouTube URL', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e( 'RSS Feed', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[rss_feed]" class="regular-text" type="text" name="shell_theme_options[rss_feed]" value="<?php esc_attr_e( $options['rss_feed'] ); ?>" />  
                        <label class="description" for="shell_theme_options[rss_feed]"><?php _e( 'Enter your RSS Feed URL', 'shell' ); ?></label>
                    </td>
                </tr>
                
                 <?php 
                /**
                 * Breadcrumbs
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Breadcrumbs', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[breadcrumbs]" class="regular-text" type="checkbox" name="shell_theme_options[breadcrumbs]" value="true" <?php if ( isset( $options['breadcrumbs'] ) && $options['breadcrumbs'] == 'true' ) { echo 'checked="checked"'; } ?> /> 
                        <label class="description" for="shell_theme_options[breadcrumbs]"><?php _e( 'Display Breadcrumbs', 'shell' ); ?></label>
                    </td>
                </tr>
                
                <?php 
                /**
                 * Authod Bio
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Author Bio', 'shell' ); ?></th>
                    <td>
                        <input id="shell_theme_options[author_bio]" class="regular-text" type="checkbox" name="shell_theme_options[author_bio]" value="true" <?php if ( isset( $options['author_bio'] ) && $options['author_bio'] == 'true' ) { echo 'checked="checked"'; } ?> /> 
                        <label class="description" for="shell_theme_options[author_bio]"><?php _e( 'Display Author Bio below Post', 'shell' ); ?></label>
                    </td>
                </tr>
            </table>
            
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'shell' ); ?>" />
            </p>
        </form>
    </div>
    <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function shell_theme_options_validate( $input ) {

    $input['home_headline'] = wp_kses_stripslashes( $input['home_headline'] );
    $input['home_content_area'] = wp_kses_stripslashes( $input['home_content_area'] );
	$input['home_subheadline'] = wp_kses_stripslashes( $input['home_subheadline'] );
    $input['featured_button_text'] = wp_kses_stripslashes( $input['featured_button_text'] );
    $input['featured_button_link'] = wp_filter_post_kses( $input['featured_button_link'] );
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
	$input['rss_feed'] = esc_url_raw( $input['rss_feed'] );
	if ( isset( $input['breadcrumbs'] ) ) {
		$input['breadcrumbs'] = wp_filter_post_kses( $input['breadcrumbs'] );	
	}
	if ( isset( $input['author_bio'] ) ) {
		$input['author_bio'] = wp_filter_post_kses( $input['author_bio'] );
	}
	
    return $input;
}