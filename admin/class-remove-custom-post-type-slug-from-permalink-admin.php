<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.indianic.com/enquiry/
 * @since      1.0.0
 *
 * @package    Remove_Custom_Post_Type_Slug_From_Permalink
 * @subpackage Remove_Custom_Post_Type_Slug_From_Permalink/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Remove_Custom_Post_Type_Slug_From_Permalink
 * @subpackage Remove_Custom_Post_Type_Slug_From_Permalink/admin
 * @author     MageINIC <support@mageinic.com>
 */
class Remove_Custom_Post_Type_Slug_From_Permalink_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Remove_Custom_Post_Type_Slug_From_Permalink_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Remove_Custom_Post_Type_Slug_From_Permalink_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/remove-custom-post-type-slug-from-permalink-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Remove_Custom_Post_Type_Slug_From_Permalink_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Remove_Custom_Post_Type_Slug_From_Permalink_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/remove-custom-post-type-slug-from-permalink-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function remove_custom_post_type_slug_from_url_post_type_link_remove_slug( $post_link, $post, $leavename ) {
		$remove_custom_post_type_slug_from_url_option_name = get_option( 'remove_custom_post_type_slug_from_url_option_name' );
		if(!empty($remove_custom_post_type_slug_from_url_option_name['custom_post_type'])){
			$cpts = $remove_custom_post_type_slug_from_url_option_name['custom_post_type'];
		}else{
			$cpts = array();
		}		
	    if ( (!in_array($post->post_type, $cpts)) || 'publish' != $post->post_status ) {
	        return $post_link;
	    }
	    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );	    
	    return $post_link;
	}

	public function remove_custom_post_type_slug_from_url_parse_request( $query ) {

	    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
	        return;
	    }

	    if ( ! empty( $query->query['name'] ) ) {
	    	$remove_custom_post_type_slug_from_url_option_name = get_option( 'remove_custom_post_type_slug_from_url_option_name' );
			if(!empty($remove_custom_post_type_slug_from_url_option_name['custom_post_type'])){
				$cpts = $remove_custom_post_type_slug_from_url_option_name['custom_post_type'];
			}else{
				$cpts = array();
			}
	        $query->set( 'post_type', $cpts );
	    }
	}

	public function remove_custom_post_type_slug_from_url_add_plugin_page() {
		add_menu_page(
			__('Remove custom post type slug from URL','remove-custom-post-type-slug-from-permalink'), 
			__('Remove custom post type slug from URL','remove-custom-post-type-slug-from-permalink'),
			'manage_options',
			'remove-custom-post-type-slug-from-url',
			array( $this, 'remove_custom_post_type_slug_from_url_create_admin_page' ),
			'dashicons-admin-settings',
			4
		);
	}

	public function remove_custom_post_type_slug_from_url_create_admin_page() {
		$this->remove_custom_post_type_slug_from_url_options = get_option( 'remove_custom_post_type_slug_from_url_option_name' ); ?>
		<div class="wrap">			
			<?php settings_errors(); ?>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'remove_custom_post_type_slug_from_url_option_group' );
					do_settings_sections( 'remove-custom-post-type-slug-from-url-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function remove_custom_post_type_slug_from_url_page_init() {
		register_setting(
			'remove_custom_post_type_slug_from_url_option_group',
			'remove_custom_post_type_slug_from_url_option_name',
			array( $this, 'remove_custom_post_type_slug_from_url_sanitize' )
		);

		add_settings_section(
			'remove_custom_post_type_slug_from_url_setting_section',
			__('Settings', 'remove-custom-post-type-slug-from-permalink'),
			array( $this, 'remove_custom_post_type_slug_from_url_section_info' ),
			'remove-custom-post-type-slug-from-url-admin'
		);

		add_settings_field(
			'custom_post_type',
			__('Custom Post types', 'remove-custom-post-type-slug-from-permalink'),
			array( $this, 'custom_post_type_callback' ),
			'remove-custom-post-type-slug-from-url-admin',
			'remove_custom_post_type_slug_from_url_setting_section'
		);
	}

	public function remove_custom_post_type_slug_from_url_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['custom_post_type'] ) ) {
			$sanitary_values['custom_post_type'] = $input['custom_post_type'];
		}

		return $sanitary_values;
	}

	public function remove_custom_post_type_slug_from_url_section_info() {
		?><p><?php echo __('Remove custom post type slug from URL', 'remove-custom-post-type-slug-from-permalink'); ?></p><?php
	}

	public function custom_post_type_callback() {
		$args       = array(
			'public' => true,
		);
		$post_types = get_post_types( $args, 'objects' );
		unset( $post_types['attachment'] );
		unset( $post_types['page'] );
		if($post_types){ ?> 
			<select name="remove_custom_post_type_slug_from_url_option_name[custom_post_type][]" id="custom_post_type" multiple>
				<?php foreach ( $post_types as $post_type_obj ):
					$selected = (isset( $this->remove_custom_post_type_slug_from_url_options['custom_post_type'] ) && ( in_array($post_type_obj->name, $this->remove_custom_post_type_slug_from_url_options['custom_post_type']) )) ? 'selected' : '' ; 
					$labels = get_post_type_labels( $post_type_obj ); ?>
					<option <?php echo esc_attr($selected); ?> value="<?php echo esc_attr( $post_type_obj->name ); ?>"><?php echo esc_html( $labels->name ); ?></option>
				<?php endforeach; ?>
			</select> 
			<?php
		}
	}
}