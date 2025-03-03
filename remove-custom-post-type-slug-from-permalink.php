<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.indianic.com/enquiry/
 * @since             1.0.0
 * @package           Remove_Custom_Post_Type_Slug_From_Permalink
 *
 * @wordpress-plugin
 * Plugin Name:       Remove custom post type slug from permalink
 * Plugin URI:        https://www.indianic.com/
 * Description:       Remove default post type and custom post type slug from URLs
 * Version:           1.0.0
 * Author:            MageINIC
 * Author URI:        https://www.indianic.com/enquiry/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       remove-custom-post-type-slug-from-permalink
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'REMOVE_CUSTOM_POST_TYPE_SLUG_FROM_PERMALINK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-remove-custom-post-type-slug-from-permalink-activator.php
 */
function activate_remove_custom_post_type_slug_from_permalink() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-remove-custom-post-type-slug-from-permalink-activator.php';
	Remove_Custom_Post_Type_Slug_From_Permalink_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-remove-custom-post-type-slug-from-permalink-deactivator.php
 */
function deactivate_remove_custom_post_type_slug_from_permalink() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-remove-custom-post-type-slug-from-permalink-deactivator.php';
	Remove_Custom_Post_Type_Slug_From_Permalink_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_remove_custom_post_type_slug_from_permalink' );
register_deactivation_hook( __FILE__, 'deactivate_remove_custom_post_type_slug_from_permalink' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-remove-custom-post-type-slug-from-permalink.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_remove_custom_post_type_slug_from_permalink() {

	$plugin = new Remove_Custom_Post_Type_Slug_From_Permalink();
	$plugin->run();

}
run_remove_custom_post_type_slug_from_permalink();