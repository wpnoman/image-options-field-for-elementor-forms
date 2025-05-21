<?php

/**
 * Plugin Name:       Image Options Field for Elementor Forms
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
define('IOFEF_FILE', __FILE__);
define('IOFEF_PLUGIN_URL', plugin_dir_url(__FILE__));
define('IOFEF_PLUGIN_DIR', plugin_dir_path(__FILE__));

function iofef_register_assets()
{
    wp_register_style(
        'iofef-style',
        IOFEF_PLUGIN_URL . 'assets/css/iofef-style.css',
        [],
        '1.0.0'
    );

    wp_register_script(
        'iofef-scripts',
        IOFEF_PLUGIN_URL . 'assets/js/iofef-scripts.js',
        ['jquery'],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'iofef_register_assets');

function iofef_register_controls($element, $args)
{

    $element->start_controls_section(
        'iofef_image_select_field_section',
        [
            'label' => __('Image Select Field', 'iofef'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $element->add_control(
        'iofef_img_select_control',
        [
            'label' => __('Enable', 'iofef'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => '',
            'description' => __('This feature only works on the frontend.', 'iofef'),
            'label_on' => 'Yes',
            'label_off' => 'No',
            'return_value' => 'yes',
        ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
        'iofef_image_select_id',
        [
            'label' => __('Image Select Field Custom ID', 'iofef'),
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::TEXT,
        ]
    );

    $repeater->add_control(
        'iofef_image_gallery',
        [
            'label' => __('Add Images', 'iofef'),
            'type' => \Elementor\Controls_Manager::GALLERY,
            'default' => [],
        ]
    );

    $element->add_control(
        'iofef_image_field_list',
        array(
            'type'    => Elementor\Controls_Manager::REPEATER,
            'fields'  => $repeater->get_controls(),
        )
    );

    $element->end_controls_section();
}

function before_render_element($element)
{
    $settings = $element->get_settings();
    if (!empty($settings['iofef_img_select_control'])) {
        print_r($settings['iofef_img_select_control']);
        if (array_key_exists('iofef_image_field_list', $settings)) {
            $rep_data = $settings['iofef_image_field_list'];
            if (!empty($rep_data[0]['iofef_image_select_id']) && !empty($rep_data[0]['iofef_image_gallery'])) {
                wp_enqueue_style('iofef-style');
                wp_enqueue_script('iofef-scripts');
                $element->add_render_attribute('_wrapper', [
                    'data-iofef-images' => esc_attr(json_encode($rep_data)),
                ]);
            }
        }
    }
}
add_action('elementor/element/form/section_form_fields/after_section_end', 'iofef_register_controls', 10, 2);
add_action('elementor/frontend/widget/before_render', 'before_render_element', 10, 1);
