<?php

/**
 * Main IOFEF Class
 *
 * The init class that runs the Advanced Addons plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * @since 1.0.0
 */
class Image_Options_Fields_Elementor
{
    /**
     *
     * $instance property for instance
     */
    private static $instance = null;

    /**
     * Plugin prefix
     *
     * @since 1.0.0
     * @var string The plugin version.
     */
    const PREFIX = 'isfef';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct()
    {

        // Init Plugin
        add_action('plugins_loaded', array($this, 'plugins_loaded'));
    }

    /**
     *
     * @return \Instance
     * @since  1.0.0
     */
    public static function getInstance()
    {
        if (! isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function plugins_loaded()
    {

        if (! did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'adae_elementor_load_notice']);
            return;
        }

        // load textdomain
        // load_plugin_textdomain('advanced-elementor-addons', false, basename(dirname(__FILE__)) . '/languages');

        $this->load_hooks();
    }

    /**
     * Check if elementor active and notice
     * 
     * @return void
     */
    public function adae_elementor_load_notice()
    {
        $elementor_pro_plugin = 'elementor-pro/elementor-pro.php';

        if ($this->is_elementor_activated()) {
            if (!is_plugin_active($elementor_pro_plugin)) {
                if (!current_user_can('activate_plugins')) {
                    return;
                }
                $activation_url = wp_nonce_url('plugins.php?action=activate&plugin=' . $elementor_pro_plugin . '&plugin_status=all&paged=1&s', 'activate-plugin_' . $elementor_pro_plugin);
                $admin_notice   = '<p>' . esc_html__('Elementor Pro is missing. You need to activate your installed Elementor Pro to use Advanced Elementor Addons.', 'tpebl') . '</p>';
                $admin_notice  .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Pro Now', 'tpebl')) . '</p>';
            }
        } else {
            if (!current_user_can('install_plugins')) {
                return;
            }
            $install_url  = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
            $admin_notice = '<p>' . esc_html__('Elementor Required. You need to install & activate Elementor to use Advanced Elementor Addons.', 'tpebl') . '</p>';
            $admin_notice .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', 'tpebl')) . '</p>';
        }

        echo '<div class="notice notice-error is-dismissible">' . wp_kses($admin_notice, [
            'a' => [
                'href' => [],
                'class' => []
            ],
            'p' => []
        ]) . '</div>';
    }

    /**
     * Elementor activated or not
     */
    public function is_elementor_activated()
    {
        $file_path         = 'elementor/elementor.php';
        $installed_plugins = get_plugins();

        return isset($installed_plugins[$file_path]);
    }


    public function isfef_register_assets()
    {
        wp_register_style(
            'isfef-style',
            ISFEF_PLUGIN_URL . 'assets/css/isfef-style.css',
            [],
            '1.0.0'
        );

        wp_register_script(
            'isfef-scripts',
            ISFEF_PLUGIN_URL . 'assets/js/isfef-scripts.js',
            ['jquery'],
            '1.0.0',
            true
        );
    }


    function load_hooks()
    {
        // enqueue assets
        add_action('wp_enqueue_scripts', [$this, 'isfef_register_assets']);

        // elementor widgets controls
        $widgets_control = new ISFEF_widgets_control();
        add_action('elementor/element/form/section_form_fields/after_section_end', [$widgets_control, 'isfef_register_controls'], 10, 2);
        add_action('elementor/frontend/widget/before_render', [$widgets_control, 'before_render_element'], 10, 1);
    }
}
