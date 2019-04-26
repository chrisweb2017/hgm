<?php

/**
 * 561TempEcom
 */
function admin_css() {
  global $user_id;

  // echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/css/oswald.css">';
  // echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/css/firasans.css">';
  // echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/css/admin.css">';

  //lets add some disable stuff for people who arent full administrator
  if ( !current_user_can( 'administrator' ) ):
    
    echo '<style>.hndle.ui-sortable-handle a.dashicons { display: none !important; }</style>';
    echo 'jQuery(document).ready(function($){ $(".inputLock").each(function(){ $(this).find("input").prop("disabled",true); }); });';

  endif;
}
add_action( 'admin_head', 'admin_css' );


function f561tempecom_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'f561tempecom' ), max( $paged, $page ) );
	}

	return $title;
}
// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

add_filter( 'wp_title', 'f561tempecom_wp_title', 10, 2 );

function twentyfourteen_widgets_init() {
  require get_template_directory() . '/inc/widgets.php';
  register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

  register_sidebar( array(
    'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
    'id'            => 'sidebar-3',
    'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );



class f561TempEcom {
  /**
   * Constructor
   */
  function __construct() {
    // Register action/filter callbacks
    add_action('after_setup_theme', array($this, 'init'));
    add_filter('excerpt_length', array($this, 'custom_excerpt_length'));
  }

  /**
   * Theme setup
   */
  function init() {
    // Register navigation menus
    register_nav_menus(
      array(
        'header-menu' => __('Header Menu', 'f561tempecom')
      )
    );
  }


  /**
   * Filter callbacks
   * ----------------
   */

  /**
   * Customize post excerpt length
   *
   * @return int The new excerpt length in words
   */
  function custom_excerpt_length () {
    return 100;
  }

  /**
   * Utility methods
   * ---------------
   */

  /**
   * Get the category id from a category name
   *
   * @param string $cat_name The category name
   * @return int The category ID
   */
  function get_category_id ($cat_name) {
    $term = get_term_by('name', $cat_name, 'category');
    return $term->term_id;
  }
}

function my_excerpt($excerpt_length = 55, $id = false, $echo = true) {
         
    $text = '';
   
          if($id) {
                $the_post = & get_post( $my_id = $id );
                $text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;
          } else {
                global $post;
                $text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');
    }
         
                $text = strip_shortcodes( $text );
                $text = apply_filters('the_content', $text);
                $text = str_replace(']]>', ']]&gt;', $text);
          $text = strip_tags($text);
       
                $excerpt_more = ' ' . '...';
                $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                if ( count($words) > $excerpt_length ) {
                        array_pop($words);
                        $text = implode(' ', $words);
                        $text = $text . $excerpt_more;
                } else {
                        $text = implode(' ', $words);
                }
        if($echo)
  echo apply_filters('the_content', $text);
        else
        return $text;
}
 

// hemingway comment function
if ( ! function_exists( 'hemingway_comment' ) ) :
function hemingway_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  
    <?php __( 'Pingback:', 'hemingway' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'hemingway' ), '<span class="edit-link">', '</span>' ); ?>
    
  </li>
  <?php
      break;
    default :
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  
    <div id="comment-<?php comment_ID(); ?>" class="comment">
    
      <div class="comment-meta comment-author vcard">
              
        <?php echo get_avatar( $comment, 120 ); ?>

        
      </div>

      <div class="comment-content post-content">
        <div class="comment-meta-content">
                      
          <?php printf( '<cite class="fn">%1$s %2$s</cite>',
            get_comment_author_link(),
            ( $comment->user_id === $post->post_author ) ? '<span class="post-author"> ' . __( '(Post author)', 'hemingway' ) . '</span>' : ''
          ); ?>
          
          <span class="comment-date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' at ' . get_comment_time() ?></a></span>
          
        </div>
      
        <?php if ( '0' == $comment->comment_approved ) : ?>
        
          <p class="comment-awaiting-moderation"><?php _e( 'Awaiting moderation', 'hemingway' ); ?></p>
          
        <?php endif; ?>
      
        <?php comment_text(); ?>
        
        <div class="comment-actions">
        
          <?php edit_comment_link( __( 'Edit', 'hemingway' ), '', '' ); ?>
          
          <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'hemingway' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          
          <div class="clear"></div>
        
        </div>
        
      </div>

    </div>
  <?php
    break;
  endswitch;
}
endif;

function get_my_excerpt($excerpt_length = 55, $id = false, $echo = false) {
 return my_excerpt($excerpt_length, $id, $echo);
} 

// Instantiate theme
$f561tempecom = new f561TempEcom();

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Appearance',
		'menu_title'	=> 'Appearance',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

  acf_add_options_sub_page(array(
    'page_title'  => 'Company Info',
    'menu_title'  => 'Company Info',
    'parent_slug' => 'theme-general-settings',
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Popup Forms',
    'menu_title'  => 'Popup Forms',
    'parent_slug' => 'theme-general-settings',
  ));  

  acf_add_options_sub_page(array(
    'page_title'  => 'Footer Info',
    'menu_title'  => 'Footer Info',
    'parent_slug' => 'theme-general-settings',
  ));  
	
}

function generate_options_css() {
    $ss_dir = get_stylesheet_directory();
    ob_start();

    $responsive_menu = hex2rgba(get_field('menu_background_color','options'), get_field('menu_background_opacity','options'));
    $transBackground = hex2rgba(get_field('accent_1_color','options'),'0.8');

    require($ss_dir . '/css/custom-style.php');
    $css = ob_get_clean();
    file_put_contents($ss_dir . '/css/custom-style.css', $css, LOCK_EX);
}
add_action('acf/save_post', 'generate_options_css', 10);


function main_image() {
  $dimg = get_template_directory_uri() . '/images/blog-default.png';
  $logo = get_field('header_logo','options');
  print "<div class='blogDefault'><img class='logo' src='$logo' /><div class='logoFloat'><img src='$dimg' /></div></div>";
}

function remove_menus(){
  global $user_id;
  global $submenu;

  if ( !current_user_can( 'administrator' ) ):
    unset( $submenu['index.php'][10] ); // removes updates
    unset( $submenu['options-general.php'][30] ); // removes media

    remove_menu_page('tools.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
    remove_menu_page('responsive-menu');
    remove_menu_page('yit_plugin_panel');
    remove_menu_page('options-media');

    /* Submenus */
    remove_submenu_page('options-general.php','clean_login_menu');
  endif;
}

add_action( 'admin_init', 'remove_menus' );

function hex2rgba($color, $opacity = false) {
   
  $default = 'rgb(0,0,0)';
 
  //Return default if no color provided
  if(empty($color))
      return $default; 
 
  //Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
      $color = substr( $color, 1 );
    }
 
    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }
 
    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);
 
    //Check if opacity is set(rgba or rgb)
    if($opacity){
      if(abs($opacity) > 1)
        $opacity = 1.0;
      $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
      $output = 'rgb('.implode(",",$rgb).')';
    }
 
    //Return rgb(a) color string
    return $output;
}

function mce_mod( $init ) {

    $style_formats = array (
    array( 'title' => 'Theme Colored Button', 'inline' => 'span', 'classes' => 'theme-colored-button' ),
    array(  
        'title' => 'Red Button',  
        'block' => 'a',  
        'classes' => 'red-button',
        'wrapper' => true,
    ),
    array(  
        'title' => 'Red Popup Button',  
        'block' => 'div',  
        'classes' => 'red-button popup',
        'wrapper' => true,
    ),      
);

    $init['style_formats'] = json_encode( $style_formats );

    $init['style_formats_merge'] = false;
    return $init;
}
add_filter('tiny_mce_before_init', 'mce_mod');

function mce_add_buttons( $buttons ){
    array_splice( $buttons, 1, 0, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'mce_add_buttons' );

// Load login stylesheet
function login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/login.css' );
}
add_action( 'login_enqueue_scripts', 'login_stylesheet' );

// Change the Login Logo URL
function login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'login_logo_url' );

//
function login_logo_url_title() {
	return 'Ausome Fitness';
}
add_filter( 'login_headertitle', 'login_logo_url_title' );

// Add theme support for Featured Images
add_theme_support('post-thumbnails', array(
  'post',
  'page',
  'custom-post-type-name',
));


/**
 * Enqueue scripts and styles.
 */
function scripts_and_styles() {
	wp_enqueue_style( 'fonts-montserrat', '//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700' );
  wp_enqueue_style( 'fonts-firasans', '//fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700,700i,800,800i,900' );
  wp_enqueue_style( 'css-global', get_template_directory_uri() . '/css/global.css' );
  wp_enqueue_style( 'css-responsive', get_template_directory_uri() . '/css/responsive.css' );
  wp_enqueue_style( 'css-custom-style', get_template_directory_uri() . '/css/custom-style.css' );
  wp_enqueue_style( 'css-font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
  wp_enqueue_style( 'css-eleganticons', get_template_directory_uri() . '/css/fonts/eleganticons/style.css' );
  wp_enqueue_script( 'js-scripts', get_template_directory_uri() . '/scripts/scripts.js', array(), '2018815', true );
  wp_enqueue_script( 'js-parallax', get_template_directory_uri() . '/scripts/parallax/jquery.parallax-1.1.3.js', array(), '2018815', true );
}
add_action( 'wp_enqueue_scripts', 'scripts_and_styles' );