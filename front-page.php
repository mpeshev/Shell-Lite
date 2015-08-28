<?php
/**
 * Front Page
 *
 * Note: You can overwrite home.php as well as any other Template in Child Theme.
 * Create the same file (name) and you're all set to go!
 *
 * @file           front-page.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/front-page.php
 * @link           N/A
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

        <div id="content-full" class="grid col-940">
        
            <?php
            // Get Shell Lite options
            $options = get_option( 'shell_theme_options' );
			
            // First let's check if headline was set
			    if ( ! empty( $options['home_headline'] ) ) {
                    echo '<h1 class="featured-title">'; 
				    echo $options['home_headline'];
				    echo '</h1>'; 
			// If not display dummy headline for preview purposes
			      } else { 
			        echo '<h1 class="featured-title">';
				    _e( 'Your H1 Headline Goes Right Here. Great for SEO!', 'shell' );
				    echo '</h1>';
				  }
			?>
        <div class="grid col-460">
        	<?php if ( empty( $options['featured_image_link'] ) || $options['featured_image_link'] == null ) { ?>
    				<img class="featured-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/featured-image.jpg" width="440" height="300" alt="" />   
        	<?php } else { ?>
        			<img class="featured-image" src="<?php echo $options['featured_image_link']; ?>" width="440" height="300" alt="" />
        	<?php } ?>
            
        </div><!-- end of .col-460 -->

        <div class="grid col-460 fit">
        
            <?php
			// First let's check if headline was set
		    if ( ! empty( $options['home_subheadline'] ) ) {
             	echo '<h2 class="featured-subtitle">'; 
			     echo $options['home_subheadline'];
			    echo '</h2>'; 
			} else { // If not display dummy headline for preview purposes
				echo '<h2 class="featured-subtitle">';
			    _e( 'Your H2 Subheadline Here', 'shell' );
			    echo '</h2>';
			  }
			?>
            
            <?php
			// First let's check if content is in place
		    if ( ! empty( $options['home_content_area'] ) ) {
				echo '<p class="featured-content-area">'; 
			    echo $options['home_content_area'];
			    echo '</p>'; 
			} else { // If not let's show dummy content for demo purposes
				echo '<p class="featured-content-area">';
				_e( 'Properly structured landing page is big part of the Search Engine Optimization. Shell is a hassle-free WordPress CMS Theme. All of the content on this landing page
				     is fully manageable directly from Theme Options, including call-to-action button and its destination.', 'shell' );
				echo '</p>';
			}
			?>                    
            
            <?php
            // Hide Featured Button if checkbox is checked
            if ( empty( $options['featured_button_hide'] ) || ( $options['featured_button_hide'] == false ) ) {
                $button_url = '#nogo';
                $button_text = __( 'Call to Action', 'shell' );
                $button_target = '';
                if ( ! empty( $options['featured_button_link'] ) ) {
                    $button_url = $options['featured_button_link'];
                }
                if ( ! empty( $options['featured_button_text'] ) ) {
                    $button_text = $options['featured_button_text'];
                }
                if ( ! empty( $options['featured_button_link_target'] ) && $options['featured_button_link_target'] == 1 ) {
                    $button_target = 'target="_blank"';
                }
                echo '<div class="featured-button"><p>';
				echo '<a href="'. $button_url .'" '. $button_target .'>'. $button_text .'</a>';
	            echo '</p></div><!-- end of .featured-button -->';
			}
			?>
        </div><!-- end of .col-460 fit --> 
        
        </div><!-- end of #content-full -->
               
<?php get_sidebar( 'home' ); ?>

<?php get_footer(); ?>