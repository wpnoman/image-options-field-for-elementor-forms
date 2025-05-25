<?php


class ISFEF_widgets_control
{


    public function isfef_register_controls($element, $args)
    {

        $element->start_controls_section(
            'isfef_image_select_field_section',
            [
                'label' => __('Image Select Field', 'isfef'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $element->add_control(
            'isfef_img_select_control',
            [
                'label' => __('Enable', 'isfef'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'description' => __('This feature only works on the frontend.', 'isfef'),
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'isfef_image_select_id',
            [
                'label' => __('Image Select Field Custom ID', 'isfef'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'isfef_image_gallery',
            [
                'label' => __('Add Images', 'isfef'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $element->add_control(
            'isfef_image_field_list',
            array(
                'type'    => Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
            )
        );

        $element->end_controls_section();
    }

    public function before_render_element($element)
    {
        $settings = $element->get_settings();
        if (!empty($settings['isfef_img_select_control'])) {
            print_r($settings['isfef_img_select_control']);
            if (array_key_exists('isfef_image_field_list', $settings)) {
                $rep_data = $settings['isfef_image_field_list'];
                if (!empty($rep_data[0]['isfef_image_select_id']) && !empty($rep_data[0]['isfef_image_gallery'])) {
                    wp_enqueue_style('isfef-style');
                    wp_enqueue_script('isfef-scripts');
                    $element->add_render_attribute('_wrapper', [
                        'data-isfef-images' => esc_attr(json_encode($rep_data)),
                    ]);
                }
            }
        }
    }
}
