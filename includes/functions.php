<?php
/**
 * Theme's Functions and Definitions
 *
 *
 * @file           functions.php
 * @package        WordPress 
 * @subpackage     Shell 
 * @author         Emil Uzelac, nofearinc 
 * @copyright      2003 - 2012 ThemeID, 2013 DevWP
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/shell-lite/includes/functions.php
 * @link           http://codex.wordpress.org/Theme_Development#Functions_File
 * @since          available since Release 1.0
 */
?>
<?php
/**
 * Fire up the engines boys and girls let's start theme setup.
 */
add_action( 'after_setup_theme', 'shell_setup' );

if ( ! function_exists( 'shell_setup' ) ):

    function shell_setup() {

        global $content_width;

        /**
         * Global content width.
         */
        if ( ! isset( $content_width ) )
            $content_width = 550;

        /**
         * Shell is now available for translations.
         * Add your files into /languages/ directory.
         */
	    load_theme_textdomain( 'shell', TEMPLATEPATH . '/languages' );

	    $locale = get_locale();
	    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
	    if ( is_readable( $locale_file ) )
		    require_once( $locale_file );
		
        /**
         * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
         * @see http://codex.wordpress.org/Function_Reference/add_editor_style
         */
        add_editor_style();

        /**
         * This feature enables post and comment RSS feed links to head.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
         */
        add_theme_support( 'automatic-feed-links' );

        /**
         * This feature enables post-thumbnail support for a theme.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
		
        /**
         * This feature enables custom-menu support for a theme.
         * @see http://codex.wordpress.org/Template_Tags/register_nav_menu
         */	
		register_nav_menu( 'primary', __( 'Primary Menu', 'shell' ) );

        // WordPress 3.4+
		if ( function_exists( 'get_custom_header' ) ) {
			
        	add_theme_support('custom-background');
		
		} else {
		
			// Backward Compatibility
			
			/**
	         * This feature allows users to use custom background for a theme.
	         * @see http://codex.wordpress.org/Function_Reference/add_custom_background
	         */
			
	        add_custom_background();
		
		}

		// WordPress 3.4+
		if ( function_exists( 'get_custom_header' ) ) {
			
		add_theme_support( 'custom-header', array (
	        // Header image default
	       'default-image'			=> get_template_directory_uri() . '/images/default-logo.png',
	        // Header text display default
	       'header-text'			=> false,
	        // Header image flex width
		   'flex-width'             => true,
	        // Header image width (in pixels)
	       'width'				    => 200,
		    // Header image flex height
		   'flex-height'            => true,
	        // Header image height (in pixels)
	       'height'			        => 100,
	        // Admin header style callback
	       'admin-head-callback'	=> 'shell_admin_header_style' 
		));
		   
		// gets included in the admin header
        function shell_admin_header_style() {
        ?>
        	<style type="text/css">
                .appearance_page_custom-header #headimg {
					border: none;
				}
             </style>
		<?php
        }
	   
	    } else {
		   
        // Backward Compatibility
		
		/**
         * This feature adds a callbacks for image header display.
		 * In our case we are using this to display logo.
         * @see http://codex.wordpress.org/Function_Reference/add_custom_image_header
         */
        define( 'HEADER_TEXTCOLOR', '' );
        define( 'HEADER_IMAGE', '%s/images/default-logo.png' ); // %s is the template dir uri
        define( 'HEADER_IMAGE_WIDTH', 300 ); // use width and height appropriate for your theme
        define( 'HEADER_IMAGE_HEIGHT', 100 );
        define( 'NO_HEADER_TEXT', true );
		
		
		// gets included in the admin header
        function shell_admin_header_style() {
        ?>
        	<style type="text/css">
                #headimg {
	                background-repeat: no-repeat;
                    border: none !important;
                    width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
                    height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
                }
             </style>
		<?php
         }
         
		 add_custom_image_header( '', 'shell_admin_header_style' );
		
	    }
	    
    }

endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function shell_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'shell_page_menu_args' );

/**
 * Filter 'get_comments_number'
 * 
 * Filter 'get_comments_number' to display correct 
 * number of comments (count only comments, not 
 * trackbacks/pingbacks)
 *
 * Adopted from http://www.chipbennett.net/ 
 */
function shell_comment_count( $count ) {  
	if ( ! is_admin() ) {
		global $id;
		// Old one... was here before Version 1.8.0
		//$comments_by_type = separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		$comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}
add_filter( 'get_comments_number', 'shell_comment_count', 0 );

/**
 * wp_list_comments() Pings Callback
 * 
 * wp_list_comments() Callback function for 
 * Pings (Trackbacks/Pingbacks)
 */
function shell_comment_list_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }

/**
 * Sets the post excerpt length to 40 characters.
 * Next few lines are adopted from Coraline
 */
function shell_excerpt_length( $length ) {
    return 40;
}

add_filter( 'excerpt_length', 'shell_excerpt_length' );

/**
 * Returns a "See more" link for excerpts
 */
function shell_see_more() {
    return ' <a href="' . get_permalink() . '">' . __( '<div class="see-more">See more &#8250;</div><!-- end of .see-more -->', 'shell' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and shell_see_more_link().
 */
function shell_auto_excerpt_more( $more ) {
    return '<span class="ellipsis">&hellip;</span>' . shell_see_more();
}

add_filter( 'excerpt_more', 'shell_auto_excerpt_more' );

/**
 * Adds a pretty "See more" link to custom post excerpts.
 */
function shell_custom_excerpt_more( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
        $output .= shell_see_more();
    }
    return $output;
}

add_filter( 'get_the_excerpt', 'shell_custom_excerpt_more' );


/**
 * This function removes inline styles set by WordPress gallery.
 */
function shell_remove_gallery_css( $css ) {
    return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

add_filter( 'gallery_style', 'shell_remove_gallery_css' );


/**
 * This function removes default styles set by WordPress recent comments widget.
 */
function shell_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'shell_remove_recent_comments_style' );


/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Courtesy of Dimox
 */
function shell_breadcrumb_lists () {
  
  $chevron = '<span class="chevron">&#8250;</span>';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="breadcrumb-current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( ! is_home() && ! is_front_page() || is_paged() ) {
 
    echo '<div class="breadcrumb-list">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $chevron . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category( $thisCat );
      $parentCat = get_category($thisCat->parent);
      
      if ( $thisCat->parent != 0 ) {
		echo( get_category_parents( $parentCat, TRUE, ' ' . $chevron . ' ' ) );
      }
      
      echo $before . __( 'Archive for ','shell' ) . single_cat_title( '', false ) . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $chevron . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $chevron . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $chevron . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $chevron . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . __('Search results for ','shell') . get_search_query() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . __('Posts tagged ','shell') . single_tag_title('', false) . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __('All posts by ','shell') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . __('Error 404 ','shell') . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','shell') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} 

    /**
     * A safe way of adding javascripts to a WordPress generated page.
     */
    if (!is_admin())
        add_action('wp_print_scripts', 'shell_js');

    if (!function_exists('shell_js')) {

        function shell_js() {
			// JavaScript at the bottom for fast page loading. 
			// except for Modernizr which enables HTML5 elements & feature detects.
			wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.5.3', false);
            wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.5', true);
        }

    }

    /**
     * Where the post has no post title, but must still display a link to the single-page post view.
     */
    add_filter('the_title', 'shell_title');

    function shell_title($title) {
        if ($title == '') {
            return 'Untitled';
        } else {
            return $title;
        }
    }

    /**
     * WordPress Widgets start right here.
     */
    function shell_widgets_init() {

        register_sidebar(array(
            'name' => __('Primary Sidebar Widget', 'shell'),
            'description' => __('Area One Primary Widget', 'shell'),
            'id' => 'primary-sidebar-widget',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '',
            'after_widget' => ''
        ));

        register_sidebar(array(
            'name' => __('Primary Home Sidebar Widget', 'shell'),
            'description' => __('Area Two Primary Home Widget', 'shell'),
            'id' => 'primary-home-sidebar-widget',
            'before_title' => '<div class="widget-title-home"><h3>',
            'after_title' => '</h3></div>',
            'before_widget' => '',
            'after_widget' => ''
        ));

        register_sidebar(array(
            'name' => __('Secondary Home Sidebar Widget', 'shell'),
            'description' => __('Area Three Secondary Home Widget', 'shell'),
            'id' => 'secondary-home-sidebar-widget',
            'before_title' => '<div class="widget-title-home"><h3>',
            'after_title' => '</h3></div>',
            'before_widget' => '',
            'after_widget' => ''
        ));

        register_sidebar(array(
            'name' => __('Tertiary Home Sidebar Widget', 'shell'),
            'description' => __('Area Four Tertiary Home Widget', 'shell'),
            'id' => 'tertiary-home-sidebar-widget',
            'before_title' => '<div class="widget-title-home"><h3>',
            'after_title' => '</h3></div>',
            'before_widget' => '',
            'after_widget' => ''
        ));

        register_sidebar(array(
            'name' => __('Gallery Widget', 'shell'),
            'description' => __('Area Five Gallery Widget', 'shell'),
            'id' => 'gallery-sidebar-widget',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '',
            'after_widget' => ''
        ));
    }
	
    add_action('widgets_init', 'shell_widgets_init');
    
    add_action( 'wp_enqueue_scripts', 'shell_enqueue_style_css' );
    function shell_enqueue_style_css() {
        wp_enqueue_style( 'style', get_stylesheet_uri() );
    }
    
    add_action( 'admin_enqueue_scripts', 'shell_enqueue_admin_style_css' );
    function shell_enqueue_admin_style_css() {
		wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/styles/admin-style.css' );
    }
    
    add_action( 'admin_enqueue_scripts', 'shell_enqueue_admin_theme_options_js' );
	function shell_enqueue_admin_theme_options_js() {
		wp_enqueue_script( 'theme-options', get_template_directory_uri() . '/js/theme-options.js' );
		
		// Add WordPress Media button support
		wp_enqueue_media();
		wp_enqueue_script( 'featured-img-uploader', get_template_directory_uri() . '/js/featured-img-uploader.js', array( 'jquery' ) );
    }
    
    /*
     * Hide Shell Lite Notice Message
     */
    add_action( 'wp_ajax_store_ajax_value', 'store_ajax_value' );
    function store_ajax_value() {
		update_option( 'shell_lite_dismiss_notice' , true );

		die();
	}
   
?>