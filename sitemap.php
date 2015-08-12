<?php
/**
 * Theme's Sitemap
 *
   Template Name: Sitemap
 *
 * @file           sitemap.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/sitemap.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<?php $options = get_option( 'shell_theme_options' ); ?>

<div id="content-sitemap" class="grid col-940">
        
	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
        
        	<?php
	        if ( function_exists( 'shell_breadcrumb_lists' ) && empty( $options['breadcrumbs'] ) ) {
	        	shell_breadcrumb_lists(); 
	        }
	        ?>
        
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1> 
                
                <div class="post-entry">
                <div id="widgets">
                
                    <div class="grid col-140">
                        <div class="widget-title"><?php _e('Pages', 'shell'); ?></div>
                            <ul><?php wp_list_pages("title_li=" ); ?></ul>
                    </div><!-- end of .col-140 -->
                    
                    <div class="grid col-140">
                        <div class="widget-title"><?php _e('RSS Feed', 'shell'); ?></div>
                            <ul>
                                <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php esc_attr_e( 'RSS', 'shell' ); ?>"><?php _e( 'RSS Feed', 'shell' ); ?></a></li>
                                <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php esc_attr_e( 'Comments RSS', 'shell' ); ?>"><?php _e( 'Comments', 'shell' ); ?></a></li>
                            </ul>
                    </div><!-- end of .col-140 -->
                    
                    <div class="grid col-140">
                        <div class="widget-title"><?php _e('Categories', 'shell'); ?></div>
                            <ul><?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&title_li='); ?></ul>
                    </div><!-- end of .col-140 -->
                    
                    <div class="grid col-140">
                    
                        <div class="widget-title"><?php _e('In Archive', 'shell'); ?></div>
                            <ul>
                                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                            </ul>
                     </div><!-- end of col-140 -->
                     
                     <div class="grid col-300 fit">

                        <div class="widget-title"><?php _e('Blog', 'shell'); ?></div>
                            <ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8');
                                    while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'shell'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
                                        </li>
                                    <?php endwhile; ?>
                            </ul>                   
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'shell'), 'after' => '</div>')); ?>
                      
                      </div><!-- end of .col-140 fit -->
                
                </div><!-- end of #widgets -->      
                </div><!-- end of .post-entry -->             
            
            <div class="post-edit"><?php edit_post_link(__('Edit', 'shell')); ?></div>  
            </div><!-- end of #post-<?php the_ID(); ?> -->
            
        <?php endwhile; ?> 
        
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div class="navigation">
			<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'shell' ) ); ?></div>
            <div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'shell' ) ); ?></div>
		</div><!-- end of .navigation -->
        <?php endif; ?> 

	    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'shell'); ?></h1>
        <p><?php _e('Don\'t panic, we\'ll get through this together. Let\'s explore our options here.', 'shell'); ?></p>
        <h6><?php _e( 'You can return', 'shell' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'home', 'shell' ); ?>"><?php _e( '&#9166; Home', 'shell' ); ?></a> <?php _e( 'or search for the page you were looking for', 'shell' ); ?></h6>
        <?php get_search_form(); ?>

	<?php endif; ?>
      
</div><!-- end of #content-sitemap -->

<?php get_footer(); ?>