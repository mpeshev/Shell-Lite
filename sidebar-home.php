<?php
/**
 * Widgetized Home Sidebar Area (Widgets)
 *
 *
 * @file           sidebar-home.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/sidebar-home.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
    <div id="widgets">
        <div class="grid col-300">
        <?php shell_widgets(); // above widgets hook ?>
            
            <?php if (!dynamic_sidebar('primary-home-sidebar-widget')) : ?>
            
                <div class="widget-title-home"><h3><?php _e('Primary Home Widget', 'shell'); ?></h3></div>
                <p>Testimonials are a powerful selling tool. Many great selling ads are made up of 1/3 testimonials of the company's products or services. This is only a suggestion, since this area is widgetized you can use it any way you please to satisfy your needs.
                </p>
            
			<?php endif; //end of primary-home-sidebar-widget ?>

        <?php shell_widgets_end(); // shell after widgets hook ?>
        </div><!-- end of .col-300 -->

        <div class="grid col-300">
        <?php shell_widgets(); // shell above widgets hook ?>
            
			<?php if (!dynamic_sidebar('secondary-home-sidebar-widget')) : ?>
            
                <div class="widget-title-home"><h3><?php _e('Secondary Home Widget', 'shell'); ?></h3></div>
                <p>Since 1975, <?php bloginfo('name'); ?> has been committed to ethically producing the highest quality service in the world. Today with more than 5000 employees worldwide <?php bloginfo('name'); ?> is still committed to same producing quality. 
                </p>
            
			<?php endif; //end of secondary-home-sidebar-widget ?>
            
            <?php shell_widgets_end(); // after widgets hook ?>
        </div><!-- end of .col-300 -->

        <div class="grid col-300 fit">
        <?php shell_widgets(); // above widgets hook ?>
            
            <?php if (!dynamic_sidebar('tertiary-home-sidebar-widget')) : ?>
            
                <div class="widget-title-home"><h3><?php _e('Tertiary Home Widget', 'shell'); ?></h3></div>
                <p>Headline, Subheadline, brief info above the call-to-action button and including the button, together with its destination link can be changed via Theme Options. Logo is uploadable as well. Three columns you see here are widgets.
                </p>
        
		    <?php endif; //end of tetriary-home-sidebar-widget ?>
            
        <?php shell_widgets_end(); // after widgets hook ?>
        </div><!-- end of .col-300 fit -->
    </div><!-- end of #widgets -->