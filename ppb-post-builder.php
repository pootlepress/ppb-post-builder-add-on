<?php
/*
Plugin Name: Pootle Post Builder Addon
Plugin URI: http://pootlepress.com/
Description: Boilerplate for fast track Pootle Page Builder Addon Development
Author: Shramee
Version: 1.0.0
Author URI: http://shramee.com/
@developer shramee <shramee.srivastav@gmail.com>
*/

/** Plugin admin class */
require 'inc/class-admin.php';
/** Including Main Plugin class */
require 'class-ppb-post-builder.php';
/** Intantiating main plugin class */
PPB_Post_Builder_Addon::instance( __FILE__ );

/** Addon update API */
add_action( 'plugins_loaded', 'PPB_Post_Builder_Addon_api_init' );

/**
 * Instantiates Pootle_Page_Builder_Addon_Manager with current add-on data
 * @action plugins_loaded
 */
function PPB_Post_Builder_Addon_api_init() {
	//Return if POOTLEPB_DIR not defined
	if ( ! defined( 'POOTLEPB_DIR' ) ) { return; }
	/** Including PootlePress_API_Manager class */
	require_once POOTLEPB_DIR . 'inc/addon-manager/class-manager.php';
	/** Instantiating PootlePress_API_Manager */
	new Pootle_Page_Builder_Addon_Manager(
		PPB_Post_Builder_Addon::$token,
		'Pootle Post Builder Addon',
		PPB_Post_Builder_Addon::$version,
		PPB_Post_Builder_Addon::$file,
		PPB_Post_Builder_Addon::$token
	);
}
