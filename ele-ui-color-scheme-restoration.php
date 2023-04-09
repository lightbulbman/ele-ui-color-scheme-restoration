<?php
/**
 * Ele UI Color Scheme Restoration
 *
 * @package       ELEUICOLOR
 * @author        George Nicolaou
 * @license       gplv2
 * @version       1.0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Ele UI Color Scheme Restoration
 * Plugin URI:    https://www.georgenicolaou.me/plugins/ele-ui-color-scheme-restoration
 * Description:   A plugin that allows you to restore the Elementor UI back to the old colors
 * Version:       1.0.1
 * Author:        George Nicolaou
 * Author URI:    https://www.georgenicolaou.me/
 * Text Domain:   ele-ui-color-scheme-restoration
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Ele UI Color Scheme Restoration. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function ELEUICOLOR() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'ELEUICOLOR_NAME',			'Ele UI Color Scheme Restoration' );

// Plugin version
define( 'ELEUICOLOR_VERSION',		'1.0.1' );

// Plugin Root File
define( 'ELEUICOLOR_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'ELEUICOLOR_PLUGIN_BASE',	plugin_basename( ELEUICOLOR_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'ELEUICOLOR_PLUGIN_DIR',	plugin_dir_path( ELEUICOLOR_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'ELEUICOLOR_PLUGIN_URL',	plugin_dir_url( ELEUICOLOR_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once ELEUICOLOR_PLUGIN_DIR . 'core/class-ele-ui-color-scheme-restoration.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  George Nicolaou
 * @since   1.0.0
 * @return  object|Ele_Ui_Color_Scheme_Restoration
 */
function ELEUICOLOR() {
	return Ele_Ui_Color_Scheme_Restoration::instance();
}


function ele_ui_color_scheme_restoration_inline_styles() {
	$css_path = plugin_dir_path( __FILE__ ) . 'core/includes/assets/css/';
  
	// Get all CSS files in the directory and subdirectories
	$css_files = glob( $css_path . '*.min.css' );
	$css_files = array_merge( $css_files, glob( $css_path . '*/**.css' ) );
  
	// Loop through each CSS file and inline its contents
	foreach ( $css_files as $css_file ) {
	  $css_contents = file_get_contents( $css_file );
	  echo '<style>' . $css_contents . '</style>';
	}
  }

add_action( 'wp_head', 'ele_ui_color_scheme_restoration_inline_styles', 999 );
add_action( 'elementor/editor/after_enqueue_styles', 'customize_elementor_editor_styles' );

function customize_elementor_editor_styles() {
    $custom_styles = '
 
    .elementor-panel #elementor-panel-header {
    background-color:#94003c;
    }
    .elementor-control-dynamic-switcher-wrapper {
    background-color:#ccccccc;
    }
    #elementor-panel-elements-search-area {
        background-color: #e7e9ec;
    }
    .elementor-panel .elementor-element {
    background-color:#ffffff;
    }
    .elementor-panel {
        background-color: #e7e9ec;
    }
    main#elementor-panel-content-wrapper * {
        border-color: #cccccc;
        color: black;
    }
    .elementor-control.elementor-control-separator-default {
        border-top: solid 1px gray;
        padding: 15px 20px;
    }
    .elementor-control-dimension-label {
        color: black !important;
    }
    .elementor-panel #elementor-panel-saver-button-publish:not(.elementor-disabled) {
        background-color: green;
        color: white;
    }
    .elementor-button.e-primary {
        background-color: green;
        color: white;
    }

    #elementor-panel-saver-button-publish
    {
    	background-color: green;
        color: white;
    }

    #elementor-panel-saver-button-save-options:hover
    {
    	background-color: green;
        color: white;
    }


    button.e-primary:hover {
        background-color: #e7e9ec;
        color: white;
    }
      .elementor-panel #elementor-panel-saver-button-publish:not(.elementor-disabled) {
        -webkit-border-end: 1px solid #3A3F45;
        border-inline-end:1px solid #3A3F45;
    } 
      ';
    wp_add_inline_style( 'elementor-editor', $custom_styles );
}
  



ELEUICOLOR();
