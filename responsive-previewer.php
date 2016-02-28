<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://twitter.com/sidonaldsoncode
 * @since             1.0.0
 * @package           Responsive_Previewer
 *
 * @wordpress-plugin
 * Plugin Name:       Responsive Previewer
 * Plugin URI:        http://twitter.com/sidonaldsoncode
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            sidonaldson
 * Author URI:        http://twitter.com/sidonaldsoncode
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       responsive-previewer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-responsive-previewer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_responsive_previewer() {

	$plugin = new Responsive_Previewer();
	$plugin->run();

}
run_responsive_previewer();
