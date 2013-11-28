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
			    if ( $options['home_headline'] ) {
                    echo '<h1 class="featured-title">'; 
				    echo $options['home_headline'];
				    echo '</h1>'; 
			// If not display dummy headline for preview purposes
			      } else { 
			        echo '<h1 class="featured-title">';
				    echo 'Your H1 Headline Goes Right Here. Great for SEO!';
				    echo '</h1>';
				  }
			?>
        <div class="grid col-460">
        	
        	<?php if ( ! isset( $options['featured_image'] ) || $options['featured_image'] == '' ) { ?>
    				<img class="featured-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/featured-image.jpg" width="440" height="300" alt="" />   
        	<?php } else { ?>
        			<img class="featured-image" src="<?php echo $options['featured_image']; ?>" width="440" height="300" alt="" />
        	<?php } ?>
            
        </div><!-- end of .col-460 -->

        <div class="grid col-460 fit">
        
            <?php
			// First let's check if headline was set
		    if ( $options['home_subheadline'] ) {
             	echo '<h2 class="featured-subtitle">'; 
			    echo $options['home_subheadline'];
			    echo '</h2>'; 
			} else { // If not display dummy headline for preview purposes
				echo '<h2 class="featured-subtitle">';
			    echo 'Your H2 Subheadline Here';
			    echo '</h2>';
			  }
			?>
            
            <?php
			// First let's check if content is in place
		    if ( $options['home_content_area'] ) {
				echo '<p class="featured-content-area">'; 
			    echo $options['home_content_area'];
			    echo '</p>'; 
			} else { // If not let's show dummy content for demo purposes
				echo '<p class="featured-content-area">';
				echo 'Properly structured landing page is big part of the Search Engine Optimization. Shell is a hassle-free WordPress CMS Theme. All of the content on this landing page
				     is fully manageable directly from Theme Options, including call-to-action button and its destination.';
				echo '</p>';
			}
			?>                    
            
            <?php
            // Hide Featured Button if checkbox is checked
            if ( ( $options['featured_button_hide'] == false ) ) {
            ?>
            
	            <div class="featured-button">
	
		            <?php
					// First let's check if headline was set
				    if ( $options['featured_button_link'] && $options['featured_button_text'] ) {
	                	echo '<p>';
	                    if ( isset( $options['featured_button_link_target'] ) && $options['featured_button_link_target'] ) {
				    		echo '<a href="'.$options['featured_button_link'].'" target="_blank">';
				    	} else {
				    		echo '<a href="'.$options['featured_button_link'].'">';
				    	}
						echo $options['featured_button_text'];
					    echo '</a></p>';
					} else { // If not display dummy headline for preview purposes
						echo '<p>';
						echo '<a href="#nogo">'; 
						echo 'Call to Action';
					    echo '</a></p>';
					  }
				?>  
	            
	            </div><!-- end of .featured-button -->
			<?php } ?>
            
        </div><!-- end of .col-460 fit --> 
        
        </div><!-- end of #content-full -->
               
<?php get_sidebar( 'home' ); ?>

<?php get_footer(); ?>