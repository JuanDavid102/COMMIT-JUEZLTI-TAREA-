<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://juezlti.eu/es/
 * @since             1.0.0
 * @package           JuezLTICommit
 *
 * @wordpress-plugin
 * Plugin Name:       JuezLTI COMMIT
 * Plugin URI:        https://juezlti.eu/es/COMMIT-uri/
 * Description:       Un COMMIT para JuezLTI
 * Version:           1.0.0
 * Author:            JuezLTI
 * Author URI:        https://juezlti.eu/es/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       COMMIT
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
define( 'JuezLTICommit_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-JuezLTICommit-activator.php
 */
function activate_JuezLTICommit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-JuezLTICommit-activator.php';
	JuezLTICommit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-JuezLTICommit-deactivator.php
 */
function deactivate_JuezLTICommit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-JuezLTICommit-deactivator.php';
	JuezLTICommit_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_JuezLTICommit' );
register_deactivation_hook( __FILE__, 'deactivate_JuezLTICommit' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-JuezLTICommit.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_JuezLTICommit() {

	$plugin = new JuezLTICommit();
	$plugin->run();

}
run_JuezLTICommit();
