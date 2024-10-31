<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.indianic.com/enquiry/
 * @since      1.0.0
 *
 * @package    Remove_Custom_Post_Type_Slug_From_Permalink
 * @subpackage Remove_Custom_Post_Type_Slug_From_Permalink/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Remove_Custom_Post_Type_Slug_From_Permalink
 * @subpackage Remove_Custom_Post_Type_Slug_From_Permalink/includes
 * @author     MageINIC <support@mageinic.com>
 */
class Remove_Custom_Post_Type_Slug_From_Permalink_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'remove-custom-post-type-slug-from-permalink',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
