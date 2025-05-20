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

add_action('elementor/element/form/section_fields/before', 'iofef_add_image_field_controls', 10, 2);

function iofef_add_image_field_controls($element, $args)
{

    $element->start_controls_section(
        'iofef_image_field_section',
        [
            'label' => __('Image Options Field', 'image-options-elementor'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $element->add_control(
        'iofef_enable_image_field',
        [
            'label' => __('Enable Image Field', 'image-options-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'image-options-elementor'),
            'label_off' => __('No', 'image-options-elementor'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $element->add_control(
        'iofef_image_choices',
        [
            'label' => __('Image Options', 'image-options-elementor'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [
                [
                    'name' => 'label',
                    'label' => __('Label', 'image-options-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('Option Label', 'image-options-elementor'),
                ],
                [
                    'name' => 'value',
                    'label' => __('Value', 'image-options-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('option_value', 'image-options-elementor'),
                ],
                [
                    'name' => 'image',
                    'label' => __('Image', 'image-options-elementor'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ],
            ],
            'default' => [],
            'title_field' => '{{ label }}',
            'condition' => [
                'iofef_enable_image_field' => 'yes',
            ],
        ]
    );

    $element->end_controls_section();
}
