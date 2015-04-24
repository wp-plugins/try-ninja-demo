<?php
/**
 * Plugin Name: Try Ninja Demo
 * Plugin URI: https://github.com/sdavis2702/try-ninja-demo
 * Description: This simple plugin adds a new widget that automatically outputs the demo entry form and allows you to specify the text to display based on whether or not a user is inside of the demo.
 * Version: 1.0.0
 * Author: Sean Davis
 * Author URI: http://seandavis.co
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 4.2
 * Domain Path: /languages/
 * 
 * This plugin is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see http://www.gnu.org/licenses/.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // no accessing this file directly


// make sure Ninja Demo is activated
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'ninja-demo/ninja-demo.php' ) ) {

	class Try_Ninja_Demo
	{	

		/**
		 * important plugin information and recourses
		 */
		public function __construct() {

			// define plugin name
			define( 'TND_NAME', 'Try Ninja Demo' );

			// define plugin version
			define( 'TND_VERSION', '1.0.0' );

			// define plugin directory
			define( 'TND_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

			// define plugin root file
			define( 'TND_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

			// load text domain
			add_action( 'init', array( $this, 'load_textdomain' ) );

			// load plugin files
			$this->includes();
		}	

		/**
		 * load TND textdomain
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'tnd', false, TND_DIR . 'languages/' );
		}		

		/**
		 * all required plugin files
		 */
		public function includes() {
			require_once( TND_DIR . 'includes/class-tnd-widget.php' );
		}
	}
	new Try_Ninja_Demo();

} // end check for Ninja Demo