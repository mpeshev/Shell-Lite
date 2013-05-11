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
 * @author          Emil Uzelac, nofearinc
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
        
            <?php $options = get_option('shell_theme_options');
			// First let's check if headline was set
			    if ($options['home_headline']) {
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
        	
        	<?php if ( !isset($options['featured_image_link']) || $options['featured_image_link'] == '') { ?>
    				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/featured-image.jpg" width="440" height="300" alt="" />   
        	<?php } else { ?>
        			<img src="<?php echo $options['featured_image_link']; ?>" width="440" height="300" alt="" />
        	<?php } ?>
            
        </div><!-- end of .col-460 -->

        <div class="grid col-460 fit">
        
            <?php $options = get_option('shell_theme_options');
			// First let's check if headline was set
			    if ($options['home_subheadline']) {
                    echo '<h2 class="featured-subtitle">'; 
				    echo $options['home_subheadline'];
				    echo '</h2>'; 
			// If not display dummy headline for preview purposes
			      } else { 
			        echo '<h2 class="featured-subtitle">';
				    echo 'Your H2 Subheadline Here';
				    echo '</h2>';
				  }
			?>
            
            <?php $options = get_option('shell_theme_options');
			// First let's check if content is in place
			    if ($options['home_content_area']) {
                    echo '<p>'; 
				    echo $options['home_content_area'];
				    echo '</p>'; 
			// If not let's show dummy content for demo purposes
			      } else { 
			        echo '<p>';
				    echo 'Properly structured landing page is big part of the Search Engine Optimization. Shell is a hassle-free WordPress CMS Theme. All of the content on this landing page
					     is fully manageable directly from Theme Options, including call-to-action button and its destination.';
				    echo '</p>';
				  }
			?>                    
            <div class="featured-button">

            <?php $options = get_option('shell_theme_options');
			// First let's check if headline was set
			    if ($options['featured_button_link'] && $options['featured_button_text']) {
                    echo '<p>';
					echo '<a href="'.$options['featured_button_link'].'">'; 
					echo $options['featured_button_text'];
				    echo '</a>';
					echo '</p>'; 
			// If not display dummy headline for preview purposes
			      } else { 
	                echo '<p>';
					echo '<a href="#nogo">'; 
					echo 'Call to Action';
				    echo '</a>';
					echo '</p>'; 
				  }
			?>  
            
            </div><!-- end of .featured-button -->
            
        </div><!-- end of .col-460 fit --> 
        
        </div><!-- end of #content-full -->
               


<?php get_sidebar('home'); ?>
<?php get_footer(); ?>