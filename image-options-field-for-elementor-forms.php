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
        'iofef_image_select_field_enable',
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
        'iofef_image_select_field_id',
        [
            'label' => __('Image Select Field Custom ID', 'iofef'),
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::TEXT,
        ]
    );

    $repeater->add_control(
        'iofef_image_select_field_gallery',
        [
            'label' => __('Add Images', 'iofef'),
            'type' => \Elementor\Controls_Manager::GALLERY,
            'default' => [],
        ]
    );

    $element->add_control(
        'iofef_image_select_field_list',
        array(
            'type'    => Elementor\Controls_Manager::REPEATER,
            'fields'  => $repeater->get_controls(),
        )
    );

    $element->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'iofef_image_select_field_typography',
            'label' => __('Typography', 'iofef'),
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
            ],
            'selector' => '{{WRAPPER}} .image_picker_selector .thumbnail p',
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_text_align',
        [
            'label' => __('Text Align', 'iofef'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'elementor'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'elementor'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .image_picker_selector .thumbnail p' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_item_width',
        [
            'label' => __('Item Width (%)', 'iofef'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 25,
            'min' => 1,
            'max' => 100,
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector li' => 'width: {{VALUE}}% !important;',
            ],
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_item_spacing',
        [
            'label' => __('Item Spacing', 'iofef'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 10,
            ]
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_item_border_radius',
        [
            'label' => __('Item Border Radius', 'iofef'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_image_border_radius',
        [
            'label' => __('Image Border Radius', 'iofef'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .image_picker_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_image_padding',
        [
            'label' => __('Input Padding', 'iofef'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .image_picker_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_label_padding',
        [
            'label' => __('Input Padding', 'iofef'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->start_controls_tabs('iofef_image_select_field_normal_active');

    $element->start_controls_tab(
        'iofef_image_select_field_normal',
        [
            'label' => __('Normal', 'elementor'),
        ]
    );

    $element->add_control(
        'iofef_image_select_field_border_normal',
        [
            'label' => __('Item Border Type', 'iofef'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => __('None', 'elementor'),
                'solid' => _x('Solid', 'Border Control', 'elementor'),
                'double' => _x('Double', 'Border Control', 'elementor'),
                'dotted' => _x('Dotted', 'Border Control', 'elementor'),
                'dashed' => _x('Dashed', 'Border Control', 'elementor'),
                'groove' => _x('Groove', 'Border Control', 'elementor'),
            ],
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail' => 'border-style: {{VALUE}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_border_width_normal',
        [
            'label' => __('Item Border Width', 'iofef'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'iofef_image_select_field_border_normal!' => '',
            ],
        ]
    );

    $element->add_control(
        'iofef_image_select_field_border_color_normal',
        [
            'label' => __('Item Border Color', 'iofef'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'iofef_image_select_field_border_normal!' => '',
            ],
        ]
    );

    $element->add_control(
        'iofef_image_select_field_background_color_normal',
        [
            'label' => __('Background Color', 'iofef'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $element->add_control(
        'iofef_image_select_field_text_color_normal',
        [
            'label' => __('Text Color', 'iofef'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail p' => 'color: {{VALUE}};',
            ],
        ]
    );

    $element->end_controls_tab();

    $element->start_controls_tab(
        'iofef_image_select_field_active',
        [
            'label' => __('Active', 'elementor'),
        ]
    );

    $element->add_control(
        'iofef_image_select_field_border_active',
        [
            'label' => __('Item Border Type', 'iofef'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => __('None', 'elementor'),
                'solid' => _x('Solid', 'Border Control', 'elementor'),
                'double' => _x('Double', 'Border Control', 'elementor'),
                'dotted' => _x('Dotted', 'Border Control', 'elementor'),
                'dashed' => _x('Dashed', 'Border Control', 'elementor'),
                'groove' => _x('Groove', 'Border Control', 'elementor'),
            ],
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail.selected' => 'border-style: {{VALUE}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'iofef_image_select_field_border_width_active',
        [
            'label' => __('Item Border Width', 'iofef'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail.selected' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'iofef_image_select_field_border_active!' => '',
            ],
        ]
    );

    $element->add_control(
        'iofef_image_select_field_border_color_active',
        [
            'label' => __('Item Border Color', 'iofef'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail.selected' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'iofef_image_select_field_border_active!' => '',
            ],
        ]
    );

    $element->add_control(
        'iofef_image_select_field_background_color_active',
        [
            'label' => __('Background Color', 'iofef'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail.selected' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $element->add_control(
        'iofef_image_select_field_text_color_active',
        [
            'label' => __('Text Color', 'iofef'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} ul.thumbnails.image_picker_selector .thumbnail.selected p' => 'color: {{VALUE}};',
            ],
        ]
    );

    $element->end_controls_tab();
    $element->end_controls_tabs();

    $element->end_controls_section();
}

// function iofef_register_controls($widgets_manager)
// {

//     require_once(__DIR__ . '/includes/class-image-select-field.php');

//     $widgets_manager->register(new \Elementor_Hello_World_Widget_1());
// }

add_action('elementor/element/form/section_form_fields/after_section_end', 'iofef_register_controls', 10, 2);
// add_action('elementor/frontend/widget/before_render', 'iofef_register_controls', 10, 1);
