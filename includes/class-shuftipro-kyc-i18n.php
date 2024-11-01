<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://shuftipro.com/pricing
 * @since      1.0.0
 *
 * @package    Shuftipro_Kyc
 * @subpackage Shuftipro_Kyc/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Shuftipro_Kyc
 * @subpackage Shuftipro_Kyc/includes
 * @author     WordPress Team ShuftiPro <tech@shuftipro.com>
 */
class Shuftipro_Kyc_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'shuftipro-kyc',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
