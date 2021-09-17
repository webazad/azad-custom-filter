<?php
/**
*------------------------------------
* :: @package azad-x
* :: @version 1.0.0
*------------------------------------
*/
// EXIT IF ACCESSED DIRECTLY
defined( 'ABSPATH' ) || exit;

define( 'AZPIG_NAME', wp_get_theme()->get( 'Name' ) );
define( 'AZPIG_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'AZPIG_TEXTDOMAIN', wp_get_theme()->get( 'TextDomain' ) );
define( 'AZPIG_DIR', trailingslashit( get_template_directory() ) );
define( 'AZPIG_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

if ( file_exists(dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

if ( class_exists( 'Azad_Guineapig\\Init' ) ) :
    Azad_Guineapig\Init::register_services();
endif;


function azad_enqueue(){
	wp_register_script(
		'azad',
		trailingslashit( get_template_directory_uri() ) . 'assets/js/azad.js',
		array( 'jquery', 'customize-preview' ),
		wp_get_theme('azad-x')->get( 'Version' ),
		true
	);
	wp_enqueue_script( 'azad' );
	wp_localize_script('azad','AZAD_JOBS',array(
		'url'       => admin_url('admin-ajax.php'),
		'security'  => wp_create_nonce('azad-job-order'),
		'success'   => 'Jobs order has been saved.',
		'failure'   => 'There was an error saving the sort order. Or you do not have proper permisions.'
	));
}
add_action( 'wp_enqueue_scripts', 'azad_enqueue' );
function azad_filter(){
	$category = $_POST['category'];
	$args = array(
		'post_type' => 'post',
		'post_per_page' => -1
	);
	if(isset($category)){
		$args = array(
			'category__in' => array($category)
		);
	}
	$custom_query = new WP_Query( $args );
	if($custom_query->have_posts()):
		while($custom_query->have_posts()): $custom_query->the_post();
			the_title('<h2>','</h2>');
		endwhile;
		wp_reset_postdata();
	endif;
	die();
    // if( ! check_ajax_referer('azad-job-order','security') ){
        // return wp_send_json_error('Invalid None ehhh!!!');
    // }
    // if(! current_user_can('manage_options')){
        // return wp_send_json_error('You do not have enough permision to do it folks.');
    // }
    // $order = $_POST['order'];
    // $counter = 0;
    // foreach($order as $item_id){
        // $post = array(
            // 'ID' => (int)$item_id,
            // 'menu_order' => $counter
        // );
        // wp_update_post($post);
        // $counter++;
    // }
    // wp_send_json_success('Post saved.');
    //update_option('azad',$order);
}
add_action('wp_ajax_filter','azad_filter');
add_action('wp_ajax_nopriv_filter','azad_filter');