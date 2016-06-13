<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

// Customize the Admin Pages
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');
function my_admin_theme_style() {
  wp_enqueue_style('my-admin-theme', get_template_directory_uri() . '/css/wp-admin.css');
}

// post thumbnail support
add_theme_support( 'post-thumbnails' );

// custom menu support
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'header-menu' => 'Header Menu'
		)
	);
}

// removes detailed login error information for security
add_filter('login_errors',create_function('$a', "return null;"));

// Shows read more links when using the except
add_filter('the_excerpt', 'excerpt_read_more_link');
function excerpt_read_more_link($output) {
 global $post;
 return $output . '<a href="'.get_permalink($post->ID).'" class="read-more">'.'Keep reading &rarr;'.'</a>';
}

// custom excerpt ellipses for 2.9+
add_filter('excerpt_more', 'custom_excerpt_more');
function custom_excerpt_more($more) {
  return '&hellip;';
}

// Use Bootstrap pager formatting for nav links
function bootstrap_get_posts_nav_link( $args = array() ) {
	global $wp_query;
	$return = '';

	if ( !is_singular() ) {
		$defaults = array(
			'prelabel' => __('&larr; Previous Page'),
			'nxtlabel' => __('Next Page &rarr;'),
		);
		$args = wp_parse_args( $args, $defaults );
		$max_num_pages = $wp_query->max_num_pages;
		$paged = get_query_var('paged');

		if ( $max_num_pages > 1 ) {
			$return = '<ul class="pager"><li class="previous">';
			$return .= get_previous_posts_link($args['prelabel']);
			$return .= '</li><li class="next">';
			$return .= get_next_posts_link($args['nxtlabel']);
			$return .= '</li></ul>';
		}
	}
	return $return;
}
function bootstrap_posts_nav_link( $prelabel = '', $nxtlabel = '' ) {
	$args = array_filter( compact('prelabel', 'nxtlabel') );
	echo bootstrap_get_posts_nav_link($args);
}

// get the slug
function the_slug($echo=true){
	global $post;
	$slug = $post->post_name;
  if( $echo ) echo $slug;
  return $slug;
}

// Remove <br> from wpautop
//Author: Simon Battersby http://www.simonbattersby.com/blog/plugin-to-stop-wordpress-adding-br-tags/
function better_wpautop($pee){
	return wpautop($pee,false);
}
remove_filter( 'the_content', 'wpautop');
add_filter( 'the_content', 'better_wpautop');
add_filter( 'the_content', 'shortcode_unautop');

// Spit out icons for all the social icons that have links
function social_icons_row($page) {
  $socialMedias = array ('facebook', 'instagram', 'twitter', 'flickr', 'linkedin', 'vimeo', 'googlePlus', 'pinterest', 'youtube');
  $return = '';
  foreach ($socialMedias as $socialMedia) {
    $socialMediaLink = esc_html( get_post_meta( $page, $socialMedia, true ) );
    $letter = social_icons_letter($socialMedia);
    if ($socialMediaLink) {
      $return .= '<a href="'.esc_attr($socialMediaLink).'" class="socicon" title="'.ucfirst(esc_attr($socialMedia)).'">'.$letter.'</a> ';
    };
  }
  return $return;
}

// Set social media icon letter with social media
function social_icons_letter($icon) {
  $socialMedias = array ( 'facebook' => 'b',
                          'instagram' => 'x',
                          'twitter' => 'a',
                          'flickr' => 'v',
                          'linkedin' => 'j',
                          'vimeo' => 's',
                          'googlePlus' => 'c',
                          'pinterest' => 'd',
                          'youtube' => 'r'
                        );
  return array_key_exists($icon, $socialMedias)? $socialMedias[$icon] : false; 
}

//Send Yoast to the bottom
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
function yoasttobottom() {
  return 'low';
}

// Setup Post 2 Post
add_action( 'p2p_init', 'my_connection_types' );
function my_connection_types() {
  p2p_register_connection_type( array( 
    'name' => 'Speakers and Events',
    'from' => 'speakers',
    'to' => 'events',
    'reciprocal' => true,
    'title' => 'Speakers + Events'
  ) );
}

// Shortcodes - Bootstrap /////////////////////////////////////
// Bootstrap row
add_shortcode( 'row', 'bootstrap_row' );
add_shortcode( 'nested_row', 'bootstrap_row' );
function bootstrap_row( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="row ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// full_col column
add_shortcode( 'full_col', 'bootstrap_full_col' );
function bootstrap_full_col( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="col-sm-12 ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// half_col column
add_shortcode( 'half_col', 'bootstrap_half_col' );
function bootstrap_half_col( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="col-sm-6 ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// two_third_col column
add_shortcode( 'two_third_col', 'bootstrap_two_third_col' );
function bootstrap_two_third_col( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="col-sm-8 ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// one_third column
add_shortcode( 'one_third_col', 'bootstrap_one_third_col' );
function bootstrap_one_third_col( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="col-sm-4 ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// quarter_width column
add_shortcode( 'quarter_col', 'bootstrap_quarter_col' );
function bootstrap_quarter_col( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="col-sm-3 ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// quarter_width column
add_shortcode( 'three_quarter_col', 'bootstrap_three_quarter_col' );
function bootstrap_three_quarter_col( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="col-sm-9 ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// Bootstrap misc col
add_shortcode( 'bootstrap_col', 'bootstrap_misc_col' );
function bootstrap_misc_col( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<div class="' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</div>';
}

// Bootstrap lead paragraph
add_shortcode( 'lead', 'bootstrap_lead_paragraph' );
function bootstrap_lead_paragraph( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => '',), $atts );
  return '<p class="lead ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</p>';
}

// Bootstrap Button
// [button label="Submit"]
add_shortcode('button', 'bootstrap_button');
function bootstrap_button( $atts ) {
  $a = shortcode_atts( array('label' => 'Submit','class' => ''), $atts );
  return '<button class="btn btn-primary '. esc_attr($a['class']) .'">'. esc_attr($a['label']) .'</button>';
}

// Scroll Button
// Scrolls to ID defined in the scroll arg
// [scroll_button label="Submit" scroll="main-footer"]
add_shortcode('scroll_button', 'bootstrap_scroll_button');
function bootstrap_scroll_button( $atts ) {
  $a = shortcode_atts( array('label' => 'Submit','scroll' => 'home','class' => ''), $atts );
  return '<button class="scroll-button btn btn-primary '. esc_attr($a['class']) .'" data-scroll="'. esc_attr($a['scroll']) .'">'. esc_attr($a['label']) .'</button>';
}

// Shortcodes ////////////////////////////////////////
// Colour Text span [text_color color="charcoal"][/text_color]
add_shortcode( 'text_color', 'et_text_color_span' );
function et_text_color_span( $atts, $content = null ) {
	$a = shortcode_atts( array('color' => 'grey',), $atts );
  return '<span class="' . esc_attr($a['color']) . '">'. do_shortcode($content) . '</span>';
}

// Light text weight span
add_shortcode( 'light', 'et_light_text_span' );
function et_light_text_span( $atts, $content = null ) {
  $a = shortcode_atts( array('color' => '',), $atts );
  return '<span class="light ' . esc_attr($a['color']) . '">'. do_shortcode($content) . '</span>';
}

// Giant text. Defaults with caps class
add_shortcode( 'giant', 'et_giant_text_caps' );
function et_giant_text_caps( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => 'caps',), $atts );
  return '<h2 class="giant-text ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</h2>';
}

// The page title
add_shortcode( 'page_title', 'et_page_title' );
function et_page_title( $atts, $content = null ) {
  $a = shortcode_atts( array('class' => 'caps',), $atts );
  return '<div class="row"><div class="col-sm-12 text-center"><h2 class="giant-text ' . esc_attr($a['class']) . '">'. do_shortcode($content) . '</h2></div></div>';
}

// Contact Form
add_shortcode('contact_form', 'et_contact_form');
function et_contact_form(){
  ob_start();  
  include('snippets/contact-form.php'); 
  $return = ob_get_contents();  
  ob_end_clean();  
  return $return;
}

// Get the Speakers
add_shortcode('get_the_speakers', 'et_get_the_speakers');
function et_get_the_speakers() {
  ob_start();  
  include('snippets/get-the-speakers.php'); 
  $return = ob_get_contents();  
  ob_end_clean();  
  return $return;
}

// Get the Events
add_shortcode('get_the_events', 'et_get_the_events');
function et_get_the_events() {
  ob_start();  
  include('snippets/get-the-events.php'); 
  $return = ob_get_contents();  
  ob_end_clean();  
  return $return;
}

// Get the events with limited information
add_shortcode('get_the_events_so_far', 'et_get_the_events_so_far');
function et_get_the_events_so_far() {
  ob_start();  
  include('snippets/get-the-events-so-far.php'); 
  $return = ob_get_contents();  
  ob_end_clean();  
  return $return;
}

// Rocket Parallax
add_shortcode('rocket_parallax', 'rocket_parallax');
function rocket_parallax() {
  $return = '<div class="rocket animate-bounce hidden-xs"><img src="'. get_template_directory_uri() . '/images/icons/rocket.svg" class="rocket-parallax">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/thrust.svg" class="thrust hidden-xs"></div>';
  $return .= '<div class="thrust-smoke"><img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="smoke-left bottom hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="smoke-left hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="cloud left bottom hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="cloud left down hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="cloud left hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/huge-cloud.svg" class="huge-cloud hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="cloud right hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="cloud right down hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="smoke-right hidden-xs">';
  $return .= '<img src="'. get_template_directory_uri() . '/images/icons/cloud.svg" class="smoke-right bottom hidden-xs"></div>';
  return $return;
}

// Robot Planet Parallax
add_shortcode('robot_planet_parallax', 'robot_planet_parallax');
function robot_planet_parallax() {
  return '<div class="col-sm-6"><img src="'. get_template_directory_uri() . '/images/icons/robot-planet.svg" class="robot-planet hidden-xs"></div>';
}

// Experience Tectoria Logo
add_shortcode('experience_tectoria_logo', 'experience_tectoria_logo');
function experience_tectoria_logo() {
  return '<img src="'. get_template_directory_uri() . '/images/icons/experience-tectoria-logo.svg" class="experience-tectoria-logo img-responsive">';
}

// Green Rocket Icon
add_shortcode('green_rocket', 'et_green_rocket_icon');
function et_green_rocket_icon( $atts ) {
  $a = shortcode_atts( array('size' => 'small',), $atts );
  return '<img src="'. get_template_directory_uri() . '/images/icons/rocket-icon-green.svg" class="rocket-icon ' . esc_attr($a['size']) . '">';
}

// Orange Rocket Icon
add_shortcode('orange_rocket', 'et_orange_rocket_icon');
function et_orange_rocket_icon( $atts ) {
  $a = shortcode_atts( array('size' => 'small',), $atts );
  return '<img src="'. get_template_directory_uri() . '/images/icons/rocket-icon-orange.svg" class="rocket-icon ' . esc_attr($a['size']) . '">';
}


// Contact Meta Box /////////////////////////////////
// Contact Information Meta Box /////////////////////
add_action('add_meta_boxes', 'et_contact_info_meta_box');
function et_contact_info_meta_box() {
  global $post;
  if ( $post->ID == get_page_by_title('Contact')->ID) {
    add_meta_box('contact_information_meta_box', 'Contact Information', 'et_contact_meta_box_formatting', 'page', 'normal');
  }
}

// Format the Contact Information Meta Box
function et_contact_meta_box_formatting($post){
  // Add an nonce field so we can check for it later.
  wp_nonce_field('contact_information_meta_box', 'contact_information_meta_box_nonce'); ?>

  <div class="meta-inline">
    <p class="meta-box-title">Email:</p>
    <input type="text" class="meta-box-input" name="email" value="<?php echo esc_html( get_post_meta( $post->ID, 'email', true )) ?>" />
  </div>
  <div class="meta-inline">
    <p class="meta-box-title">Address:</p>
    <input type="text" class="meta-box-input" name="address" value="<?php echo esc_html( get_post_meta( $post->ID, 'address', true )) ?>" />
  </div>
  <div style="clear:both"></div>

  <?  // Open up PHP again 
}

// Save Contact Information Meta Box
add_action('save_post', 'et_contact_info_meta_box_save_data');
function et_contact_info_meta_box_save_data($post_id) {
  if (isset($_POST['hidden_flag'])) {
    global $post;
    // Check if our nonce is set.
    if ( !isset( $_POST['contact_information_meta_box_nonce'] ) ) { return; }
    // Verify that the nonce is valid.
    if ( !wp_verify_nonce( $_POST['contact_information_meta_box_nonce'], 'contact_information_meta_box' ) ) { return; }
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

    if ( !current_user_can( 'edit_post', $post->ID )) return $post->ID;   // Authenticate user

    // Check for Meta Value
    $metaValues = array ('email', 'address');
    foreach ($metaValues as $metaValue) {
      if (isset($_POST[$metaValue])) {
        $custom_type_meta_values[$metaValue] = $_POST[$metaValue];
      }
    }

    // Finally ready to save the data
    if (isset($custom_type_meta_values)) {
      foreach ($custom_type_meta_values as $key => $value) {
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
          update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
          add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
      }
    }
  }
}

// Custom Post Types ///////////////////////////////
// Event Custom Posts
add_action( 'init', 'et_events_custom_type' );
function et_events_custom_type() {
  $labels = array(
    'name'               => 'Events',
    'singular_name'      => 'Event',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Event',
    'edit_item'          => 'Edit Event',
    'new_item'           => 'New Event',
    'all_items'          => 'All Events',
    'view_item'          => 'View Event',
    'search_items'       => 'Search Events',
    'not_found'          => 'No Events found',
    'not_found_in_trash' => 'No Events found in the Trash',
    'menu_name'          => 'Events'
  );
  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title' ),
    'menu_icon' => 'dashicons-calendar',
    'exclude_from_search' => true,
    'query_var' => true,
    'register_meta_box_cb' => 'events_meta_boxes',
    'has_archive'   => true
  );
  register_post_type( 'events', $args ); 
}
function events_meta_boxes() {
  custom_post_add_metabox('event','Event');
}

// Speaker Custom Posts
add_action( 'init', 'speakers_custom_type' );
function speakers_custom_type() {
  $labels = array(
    'name'               => 'Speakers',
    'singular_name'      => 'Speaker',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Speaker',
    'edit_item'          => 'Edit Speaker',
    'new_item'           => 'New Speaker',
    'all_items'          => 'All Speakers',
    'view_item'          => 'View Speaker',
    'search_items'       => 'Search Speakers',
    'not_found'          => 'No Speakers found',
    'not_found_in_trash' => 'No Speakers found in the Trash',
    'menu_name'          => 'Speakers'
  );
  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'menu_position' => 7,
    'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
    'menu_icon' => 'dashicons-businessman',
    'exclude_from_search' => true,
    'query_var' => true,
    'register_meta_box_cb' => 'speakers_meta_boxes',
    'has_archive'   => true
  );
  register_post_type( 'speakers', $args ); 
}
function speakers_meta_boxes() {
  custom_post_add_metabox('speaker','Speaker');
}

// Custom Post Saving functions /////////////////////////////////////
// Add Meta boxes to the custom post edit page
// Arguments take singular name: First with underscore, Second without
// Use: custom_post_add_metabox('team_member','Team Member'); 
function custom_post_add_metabox($metaSlug, $customTypeName){
  add_meta_box($metaSlug.'_meta_box', $customTypeName, 'custom_post_meta_box_view', $metaSlug.'s', 'normal', 'default', array('metaSlug'=>$metaSlug));
}

// Format the Meta Boxes
function custom_post_meta_box_view($post, $metaSlug) {
  global $post;
  $metaSlug = $metaSlug['args']['metaSlug'];
  wp_nonce_field($metaSlug.'_meta_box', $metaSlug.'_meta_box_nonce');
  include('snippets/metaboxes/'.$metaSlug.'.php');
}

// Save the Metabox Data
add_action('save_post', 'et_save_meta_boxes', 1, 2); // save the custom fields
function et_save_meta_boxes($post_id, $post) {
  //global $post;
  //$metaSlug = $metaSlug['args']['metaSlug'];
  // Check if our nonce is set.
  //if ( !isset( $_POST[$metaSlug.'_meta_box_nonce'] ) ) { return; }
  // Verify that the nonce is valid.
  //if ( !wp_verify_nonce( $_POST[$metaSlug.'_meta_box_nonce'], $metaSlug.'_meta_box' ) ) { return; }

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if (isset($_POST['hidden_flag'])) { 
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

    if ( !current_user_can( 'edit_post', $post->ID )) return $post->ID;   // Authenticate user

    // Check for Meta Value
    $metaValues = array('position', 'email', 'website', 'date', 'start_time', 'end_time', 'location', 'ticket_link', 'pass_type');
    foreach ($metaValues as $metaValue) {
      if (isset($_POST[$metaValue])) {
        $custom_type_meta_values[$metaValue] = $_POST[$metaValue];
      } else {
        update_post_meta( $post_id, $metaValue, 0 ); // save unchecked check-boxes
      }
    }

    // Finally ready to save the data
    if (isset($custom_type_meta_values)) {
      foreach ($custom_type_meta_values as $key => $value) {
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
          update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
          add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
      }
    }
  }
}

// Social Media Meta Box /////////////////////////////
add_action('add_meta_boxes', 'social_media_meta_box');
function social_media_meta_box() {
  global $post;
  if ( $post->ID == get_page_by_title('Contact')->ID) {
    //add social media to Contact Page
    add_meta_box('social_media_meta_box', 'Social Media Links', 'social_media_meta_box_formatting', 'page', 'normal', 'low');
  }
  add_meta_box('social_media_meta_box', 'Social Media Links', 'social_media_meta_box_formatting', 'speakers', 'normal', 'low');
}

// Format the Contact Information Meta Box
function social_media_meta_box_formatting($post){
  // Add an nonce field so we can check for it later.
  wp_nonce_field('social_media_meta_box', 'social_media_meta_box_nonce');
  include('snippets/metaboxes/social_media.php');
}

// Save Contact Information Meta Box
add_action('save_post', 'social_media_meta_box_save_data');
function social_media_meta_box_save_data($post_id) {
  if (isset($_POST['hidden_flag'])) {
    global $post;
    // Check if our nonce is set.
    if ( !isset( $_POST['social_media_meta_box_nonce'] ) ) { return; }
    // Verify that the nonce is valid.
    if ( !wp_verify_nonce( $_POST['social_media_meta_box_nonce'], 'social_media_meta_box' ) ) { return; }
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

    if ( !current_user_can( 'edit_post', $post->ID )) return $post->ID;   // Authenticate user

    // Check for Meta Value
    $metaValues = array ('facebook', 'instagram', 'twitter', 'flickr', 'linkedin', 'vimeo', 'googlePlus', 'pinterest', 'youtube');
    foreach ($metaValues as $metaValue) {
      if (isset($_POST[$metaValue])) {
        $custom_type_meta_values[$metaValue] = $_POST[$metaValue];
      }
    }

    // Finally ready to save the data
    if (isset($custom_type_meta_values)) {
      foreach ($custom_type_meta_values as $key => $value) {
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
          update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
          add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
      }
    }
  }
}

// Load scripts ////////////////////////////////////
add_action('wp_enqueue_scripts','et_scripts_init');
function et_scripts_init() {
	wp_enqueue_script( 'jquery' );

  wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
  wp_enqueue_script('bootstrap');

  wp_register_script( 'modernizr', get_template_directory_uri() . '/js/webshim/modernizr-custom.js', array( 'jquery') );
  wp_enqueue_script( 'modernizr' );

  wp_register_script( 'webshim', get_template_directory_uri() . '/js/webshim/polyfiller.js', array( 'jquery', 'modernizr' ) );
  wp_enqueue_script( 'webshim' );

  wp_register_script( 'webshim_init', get_template_directory_uri() . '/js/webshim_init.js');
  wp_enqueue_script('webshim_init');

  wp_register_script( 'et_scripts', get_template_directory_uri() . '/js/scripts.js');
  wp_enqueue_script('et_scripts');

  wp_localize_script('et_scripts', 'et_scripts_vars', array(
      'template_path' => get_bloginfo('template_directory')
    )
  );
}

add_action('admin_enqueue_scripts', 'et_admin_scripts');
function et_admin_scripts() {
  wp_register_script( 'modernizr', get_template_directory_uri() . '/js/webshim/modernizr-custom.js', array( 'jquery') );
  wp_enqueue_script( 'modernizr' );

  wp_register_script( 'webshim', get_template_directory_uri() . '/js/webshim/polyfiller.js', array( 'jquery', 'modernizr' ) );
  wp_enqueue_script( 'webshim' );

  wp_register_script( 'webshim_init', get_template_directory_uri() . '/js/webshim_init.js');
  wp_enqueue_script('webshim_init');
}
