<?php
/**
 * Plugin Name: Crocoblock Demo Banner
 * Description: Crocoblock Demo Banner
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: crocoblock-demo-banner
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// If class `Crocoblock_Demo_Banner` doesn't exists yet.
if ( ! class_exists( 'Crocoblock_Demo_Banner' ) ) {

	/**
	 * Sets up and initializes the plugin.
	 */
	class Crocoblock_Demo_Banner {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Holder for base plugin URL
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_url = null;

		/**
		 * Plugin version
		 *
		 * @var string
		 */
		private $version = '1.0.0';

		/**
		 * Holder for base plugin path
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_path = null;

		/**
		 * Settings.
		 *
		 * @var array
		 */
		private $settings = array();

		/**
		 * Remote data url.
		 *
		 * @var string
		 */
		private $remote_data_url = 'https://raw.githubusercontent.com/yuriybratchenko/crocoblock-data/master/data.json';

		/**
		 * Transient key.
		 *
		 * @var string
		 */
		private $transient_key = 'crocoblock_demo_banner_settings';

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {

			// Internationalize the text strings used.
			add_action( 'init', array( $this, 'lang' ), -999 );

			// Init.
			add_action( 'init', array( $this, 'init' ), -999 );

			// Enqueue public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ));

			// Print button.
			add_action( 'wp_head', array( $this, 'print_banner' ) );

			// Register activation and deactivation hook.
			register_activation_hook( __FILE__, array( $this, 'activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );
		}

		/**
		 * Init.
		 */
		public function init() {
			$this->delete_cache_handle();
		}

		/**
		 * Get settings.
		 *
		 * @return array
		 */
		public function get_settings() {
			if ( ! empty( $this->settings ) ) {
				return $this->settings;
			}

			$this->settings = array( 'price' => 199 ); // default settings

			$settings = get_transient( $this->transient_key );

			if ( ! $settings ) {

				$response = wp_remote_get( $this->remote_data_url, array( 'timeout' => 30 ) );

				if ( ! $response || is_wp_error( $response ) ) {
					return $this->settings;
				}

				$body = wp_remote_retrieve_body( $response );

				if ( ! $body || is_wp_error( $body ) ) {
					return $this->settings;
				}

				$settings = json_decode( $body, true );

				if ( empty( $settings ) ) {
					return $this->settings;
				}

				set_transient( $this->transient_key, $settings, DAY_IN_SECONDS );
			}

			$this->settings = wp_parse_args( $settings, $this->settings );

			return $this->settings;
		}

		/**
		 * Delete cache handle.
		 */
		public function delete_cache_handle() {
			if ( ! isset( $_GET['crocoblock_data_clear_cache'] ) ) {
				return;
			}

			delete_transient( $this->transient_key );
		}

		/**
		 * Enqueue public assets.
		 */
		public function enqueue_assets() {
			wp_enqueue_style( 'crocoblock-demo-banner', $this->plugin_url( 'assets/css/frontend.css' ), false, $this->get_version() );
		}

		/**
		 * Print button.
		 */
		public function print_banner() {
			require_once $this->plugin_path( 'templates/banner.php' );
		}

		/**
		 * Returns plugin version
		 *
		 * @return string
		 */
		public function get_version() {
			return $this->version;
		}

		/**
		 * Returns path to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}

		/**
		 * Returns url to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
			}

			return $this->plugin_url . $path;
		}

		/**
		 * Loads the translation files.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function lang() {
			load_plugin_textdomain( 'crocoblock-demo-banner', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Do some stuff on plugin activation
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function activation() {}

		/**
		 * Do some stuff on plugin activation
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function deactivation() {}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

if ( ! function_exists( 'crocoblock_demo_banner' ) ) {

	/**
	 * Returns instanse of the plugin class.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	function crocoblock_demo_banner() {
		return Crocoblock_Demo_Banner::get_instance();
	}
}

crocoblock_demo_banner();
