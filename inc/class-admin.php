<?php
/**
 * Pootle Post Builder Addon Admin class
 * @property string token Plugin token
 * @property string $url Plugin root dir url
 * @property string $path Plugin root dir path
 * @property string $version Plugin version
 */
class PPB_Post_Builder_Addon_Admin{

	/**
	 * @var 	PPB_Post_Builder_Addon_Admin Instance
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Main Pootle Post Builder Addon Instance
	 * Ensures only one instance of Storefront_Extension_Boilerplate is loaded or can be loaded.
	 * @return PPB_Post_Builder_Addon instance
	 * @since 	1.0.0
	 */
	public static function instance() {
		if ( null == self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Constructor function.
	 * @access  private
	 * @since 	1.0.0
	 */
	private function __construct() {
		$this->token   =   PPB_Post_Builder_Addon::$token;
		$this->url     =   PPB_Post_Builder_Addon::$url;
		$this->path    =   PPB_Post_Builder_Addon::$path;
		$this->version =   PPB_Post_Builder_Addon::$version;
	} // End __construct()

	/**
	 * Initiates Settings API sections, controls and settings
	 * @action init
	 * @since    1.0.0
	 */
	public function init_settings() {
		// Finally, we register the fields with WordPress
		add_settings_field( 'post-types', __( 'Post Types', 'ppb-panels' ), array(
			$this,
			'post_types_field',
		), 'pootlepage-display', 'display' );

	}

	public function post_types_field() {
		$pt_set = pootlepb_settings( 'post-types' );
		$post_types = get_post_types( array( 'public'   => true, ), 'objects' );

		$chkbx_format = '<input type="checkbox" name="pootlepb_display[post-types][]" value="%s" %s>%s<br>';

		foreach ( $post_types as $pt ) {
			printf( $chkbx_format, $pt->name, checked( in_array( $pt->name, $pt_set ), 1, 0 ), $pt->labels->name );
		}
	}

	/**
	 * Adds chosen post types to pb supported post types
	 * @param array $post_types
	 * @action pootlepb_builder_post_types
	 * @return array
	 */
	public function add_post_types( $post_types ) {
		$ppb_settings = get_option( 'pootlepb_display' );

		if ( $ppb_settings && ! empty( $ppb_settings['post-types'] ) ) {
			return $ppb_settings['post-types'];
		}
		return $post_types;
	}
}