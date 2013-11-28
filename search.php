<?php
/**
 * Theme's Search
 *
 *
 * @file           search.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/shell-lite/search.php
 * @link           http://codex.wordpress.org/Theme_Development#Search_Results_.28search.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

        <div id="content" class="grid col-620">
            <h6><?php _e('We found','shell');?> 
			<?php
                $allsearch = new WP_Query( "s=$s&showposts=-1" );
                $key = esc_html( $s, 1 );
                $count = $allsearch->post_count;
                _e( ' &#8211; ', 'shell' );
                echo $count . ' ';
                _e( 'articles for ', 'shell' );
                _e( '<span class="post-search-terms">', 'shell' );
                echo $key;
                _e( '</span><!-- end of .post-search-terms -->', 'shell' );
                wp_reset_query();
            ?>
            </h6>


<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
          
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'shell' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h1>

                <div class="post-meta">
                    <?php the_time( __( 'F jS, Y', 'shell' ) ) ?>
                    <?php the_author() ?>
                </div><!-- end of .post-meta -->
                                
                <div class="post-entry">
                    <?php the_content( __( 'Read more &raquo;', 'shell' ) ); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'shell'), 'after' => '</div><!-- end of .pagination -->' ) ); ?>
                </div><!-- end of .post-entry -->
                
                <div class="post-data">
				    <?php the_tags( __( 'Tagged with:', 'shell' ) . ' ', ', ', '<br />' ); ?> 
					<?php printf( __( 'Posted in %s', 'shell' ), get_the_category_list( ', ' ) ); ?> | 
					<?php edit_post_link( __( 'Edit', 'shell' ), '', ' | ' ); ?>  
					<?php comments_popup_link( __( 'No Comments &#187;', 'shell' ), __( '1 Comment &#187;', 'shell' ), __( '% Comments &#187;', 'shell' ), '', __( 'Comments Closed', 'shell' ) ); ?>
                </div><!-- end of .post-data -->             
            
            </div><!-- end of #post-<?php the_ID(); ?> -->
            
			<?php comments_template( '', true ); ?>
            
        <?php endwhile; ?> 
        
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div class="navigation">
			<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'shell' ) ); ?></div>
            <div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'shell' ) ); ?></div>
		</div><!-- end of .navigation -->
        <?php endif; ?> 

	    <?php else : ?>

        <h1 class="title-404"><?php _e( '404 &#8212; Fancy meeting you here!', 'shell' ); ?></h1>
        <p><?php _e( 'Don\'t panic, we\'ll get through this together. Let\'s explore our options here.', 'shell' ); ?></p>
        <h6><?php _e( 'You can return', 'shell' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'home', 'shell' ); ?>"><?php _e( '&#9166; Home', 'shell' ); ?></a> <?php _e( 'or search for the page you were looking for', 'shell' ); ?></h6>
        <?php get_search_form(); ?>

<?php endif; ?>  
      
        </div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>