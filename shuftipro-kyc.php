<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://shuftipro.com/pricing
 * @since             1.0.0
 * @package           Shuftipro_Kyc
 *
 * @wordpress-plugin
 * Plugin Name:       Shuftipro KYC Identity Verification
 * Plugin URI:        https://shuftipro.com
 * Description:       With the Shuftipro KYC Verification Plugin for WordPress, You can connect with identity verification platform in the world. Easily add to the website.
 * Version:           1.1.6
 * Author:            WordPress Team ShuftiPro
 * Author URI:        https://shuftipro.com/pricing
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shuftipro-kyc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SHUFTIPRO_KYC_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-shuftipro-kyc-activator.php
 */
function activate_shuftipro_kyc()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-shuftipro-kyc-activator.php';
	Shuftipro_Kyc_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-shuftipro-kyc-deactivator.php
 */
function deactivate_shuftipro_kyc()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-shuftipro-kyc-deactivator.php';
	Shuftipro_Kyc_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_shuftipro_kyc');
register_deactivation_hook(__FILE__, 'deactivate_shuftipro_kyc');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-shuftipro-kyc.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_shuftipro_kyc()
{

	$plugin = new Shuftipro_Kyc();
	$plugin->run();

	// create the custom table
	global $wpdb;

	// $table_name = $wpdb->prefix . 'kyc_verification';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS wp_kyc_verification (
        id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        client_id varchar(255) NOT NULL,
        secret_key varchar(255) NOT NULL) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);


	$sqltab2 = "CREATE TABLE IF NOT EXISTS payloadsetting (
        id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        verification_mode varchar(255) NOT NULL,
        redirect_url varchar(255) NOT NULL,
		show_consent varchar(255) NOT NULL,
		callback_url varchar(255) NOT NULL,
		show_results varchar(255) NOT NULL,
		privacy_policy varchar(255) NOT NULL,
		enhanced_data varchar(255) NOT NULL,
		show_feedback varchar(255) NOT NULL,
		country varchar(255) NOT NULL,
		select_language varchar(255) NOT NULL) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sqltab2);
	
}
run_shuftipro_kyc();


?>