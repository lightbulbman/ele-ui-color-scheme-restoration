<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Ele_Ui_Color_Scheme_Restoration_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if ( ! class_exists( 'Ele_Ui_Color_Scheme_Restoration' ) ) :

	/**
	 * Main Ele_Ui_Color_Scheme_Restoration Class.
	 *
	 * @package		ELEUICOLOR
	 * @subpackage	Classes/Ele_Ui_Color_Scheme_Restoration
	 * @since		1.0.0
	 * @author		George Nicolaou
	 */
	final class Ele_Ui_Color_Scheme_Restoration {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Ele_Ui_Color_Scheme_Restoration
		 */
		private static $instance;

		/**
		 * ELEUICOLOR helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Ele_Ui_Color_Scheme_Restoration_Helpers
		 */
		public $helpers;

		/**
		 * ELEUICOLOR settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Ele_Ui_Color_Scheme_Restoration_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'ele-ui-color-scheme-restoration' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'ele-ui-color-scheme-restoration' ), '1.0.0' );
		}

		/**
		 * Main Ele_Ui_Color_Scheme_Restoration Instance.
		 *
		 * Insures that only one instance of Ele_Ui_Color_Scheme_Restoration exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Ele_Ui_Color_Scheme_Restoration	The one true Ele_Ui_Color_Scheme_Restoration
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Ele_Ui_Color_Scheme_Restoration ) ) {
				self::$instance					= new Ele_Ui_Color_Scheme_Restoration;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Ele_Ui_Color_Scheme_Restoration_Helpers();
				self::$instance->settings		= new Ele_Ui_Color_Scheme_Restoration_Settings();

				//Fire the plugin logic
				new Ele_Ui_Color_Scheme_Restoration_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'ELEUICOLOR/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once ELEUICOLOR_PLUGIN_DIR . 'core/includes/classes/class-ele-ui-color-scheme-restoration-helpers.php';
			require_once ELEUICOLOR_PLUGIN_DIR . 'core/includes/classes/class-ele-ui-color-scheme-restoration-settings.php';
			require_once ELEUICOLOR_PLUGIN_DIR . 'core/includes/classes/class-ele-ui-color-scheme-restoration-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'ele-ui-color-scheme-restoration', FALSE, dirname( plugin_basename( ELEUICOLOR_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.