<?php

/**
 * Plugin Name:       Image Select Field for Elementor Forms
 * Plugin URI:        https://
 * Description:       Image Options Field for Elementor Forms is a powerful addon that extends the native Elementor Form widget by adding a custom image selection field. Let your users select options visually through images—perfect for forms that require choices like product styles, services, packages, or preferences.
 * Author:            WPNoman
 * Author URI:        
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       international-telephone-field-for-elementor-form
 * Domain Path:       /languages
 * Version:           1.0.2
 * Requires PHP:      7.4
 * Requires at least: 6.2
 * Requires Plugins:  elementor
 *
 */


if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/*** Defined constant for later use */
define('ISFEF_FILE', __FILE__);
define('ISFEF_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ISFEF_PLUGIN_PATH', plugin_dir_path(__FILE__));

/**
 * Load file fiels
 */
require ISFEF_PLUGIN_PATH . 'includes/class-image-select-field-for-elementor-forms.php';
require ISFEF_PLUGIN_PATH . 'includes/class-isfef-widgets-control.php';


if (! function_exists('Image_Options_Fields_Elementor')) {
    function ADAE_init()
    {
        return Image_Options_Fields_Elementor::getInstance();
    }
    ADAE_Init();
}
