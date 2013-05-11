<?php
/**
 * Widgetized Sidebar Area (Widgets)
 *
 *
 * @file           sidebar.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author          Emil Uzelac, nofearinc 
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/sidebar.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
        <div id="widgets" class="grid col-300 fit">
        <?php shell_widgets(); // above widgets hook ?>
            
            <?php if (!dynamic_sidebar('primary-sidebar-widget')) : ?>
            
                <div class="widget-title"><?php _e('In Archive', 'shell'); ?></div>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>

                <div class="widget-title"><?php _e('My Account', 'shell'); ?></div>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>

            <?php endif; //end primary-widget ?>

        <?php shell_widgets_end(); // after widgets hook ?>
        </div><!-- end of #widgets -->