<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('SEON_Settings')) {

    class SEON_Settings {

        private $seon_settings_fields = array(
            'seon_licence_key' => '',
            'seon_activate_plugin' => '',
            'seon_activate_agent' => ''
        );

        /**
         * Construct
         *
         * @since 1.0.0
         * @access public
         *
         */
        public function __construct() {
            if (current_user_can('manage_options')) {
                add_action('network_admin_menu', array(&$this, 'seon_add_network_settings'));
                add_action('admin_menu', array(&$this, 'seon_add_site_settings'));
            }
        }

        /**
         * Add site settings menu
         *
         * @since 1.0.0
         * @access public
         *
         */
        public function seon_add_site_settings() {
            if (is_admin() || is_super_admin())
                add_submenu_page('options-general.php', __('SEON API Settings', 'seon'), __('SEON API', 'seon'), 'administrator', 'seon-site-settings', array(&$this, 'seon_site_settings'));
        }

        /**
         * Add network settings menu
         *
         * @since 1.0.0
         * @access public
         *
         */
        public function seon_add_network_settings() {
            if (is_super_admin())
                add_submenu_page('settings.php', __('SEON API Settings', 'seon'), __('SEON API', 'seon'), 'administrator', 'seon-network-settings', array(&$this, 'seon_admin_settings'));
        }

        /**
         * Add site settings
         *
         * @since 1.0.0
         * @access public
         *
         */
        public function seon_site_settings() {
            $this->seon_settings();
        }

        /**
         * Add network settings
         *
         * @since 1.0.0
         * @access public
         *
         */
        public function seon_admin_settings() {
            $this->seon_settings(true);
        }

        /**
         * Seon settings
         *
         * @since 1.0.0
         * @access public
         * @params $site
         *
         */
        public function seon_settings($site = false) {

            $seon_settings_fields = $this->seon_settings_fields;
            $checked = '';


            /* Verify the nonce before proceeding. */
            if (isset($_POST['seon_nonce']) && wp_verify_nonce($_POST['seon_nonce'], basename(__FILE__))) {

                foreach ($this->seon_settings_fields as $field => $val) {
                    if (isset($_POST[$field])) {
                        $seon_settings_fields[$field] = sanitize_html_class($_POST[$field]);
                    }
                }

                foreach ($seon_settings_fields as $key => $val) {
                    if (( $key && ( '' != $val || !empty($val) ))) {
                        /* Add/Update Options */
                        if ($site) {
                            update_site_option($key, $val);
                        } else {
                            update_option($key, $val);
                        }
                    } elseif (( $key && ( '' == $val || empty($val) ))) {
                        /* Delete Option If Empty */
                        if ($site) {
                            delete_site_option($key);
                        } else {
                            delete_option($key);
                        }
                    }
                }
            }
            echo $this->seon_settings_html($site);
        }

        /**
         * Seon settings content
         *
         * @since 1.0.0
         * @access public
         * @params $site
         *
         */
        public function seon_settings_html($site = false) {


            $seon_settings_fields = $this->seon_settings_fields;

            /* Setting Options */
            foreach ($seon_settings_fields as $field => $val) {
                if ($site) {
                    if (get_site_option($field, '')) {
                        $seon_settings_fields[$field] = get_site_option($field, '');
                    }
                } else {
                    if (get_option($field, '')) {
                        $seon_settings_fields[$field] = get_option($field, '');
                    }
                }
            }

            $html = '<div class="wrap">';
            $html = '<div class="seon-settings-container">';
            $html .= '<section class="seon-settings">';
            $html .= '<div class="seon-settings-content">';
            $html .= '<form method="POST">';
            $html .= wp_nonce_field(basename(__FILE__), 'seon_nonce', true, false);
            $seon_nonce = wp_create_nonce("seon_nonce");


            $html .= '<table class="form-table" border="0">';
            $html .= '<tr valign="top">';
            $html .= '<th scope="row" class="seon-title">';
            $html .= '<label for="num_elements">';
            $html .= __('SEON Fraud API', 'seon');
            $html .= '</label>';
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>';
            $html .= '<p class="seon-settings-heading">' . __('API Licence Key', 'seon') . '</p>';
            $html .= '<input type="text" class="regular-text" name="seon_licence_key" value="' . $seon_settings_fields['seon_licence_key'] . '">';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>';
            $html .= '<p class="seon-settings-heading">' . __('Javascript Agent', 'seon') . '</p>';
            $html .= '<input type="radio" ' . ( $seon_settings_fields['seon_activate_agent'] == 1 ? 'checked ' : '') . 'class="regular-radio first" name="seon_activate_agent" value="1"> <label for="">' . __('Enabled', 'seon') . '</label>';
            $html .= '<input type="radio" ' . ( $seon_settings_fields['seon_activate_agent'] == 0 ? 'checked ' : '') . 'class="regular-radio" name="seon_activate_agent" value="0"> <label for="">' . __('Disabled', 'seon') . '</label>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>';
            $html .= '<p class="seon-settings-heading">' . __('Activated', 'seon') . '</p>';
            $html .= '<input type="radio" ' . ( $seon_settings_fields['seon_activate_plugin'] == 1 ? 'checked ' : '') . 'class="regular-radio first" name="seon_activate_plugin" value="1"> <label for="">' . __('Enabled', 'seon') . '</label>';
            $html .= '<input type="radio" ' . ( $seon_settings_fields['seon_activate_plugin'] == 0 ? 'checked ' : '') . 'class="regular-radio" name="seon_activate_plugin" value="0"> <label for="">' . __('Disabled', 'seon') . '</label>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '</table>';
            $html .= '<span class="seon-settings-submit">';
            $html .= '<input type="submit" value="' . __('Save settings', 'seon') . '" class="button-primary"/>';
            $html .= '</span>';


            $html .= '</form>';
            $html .= '</div>';
            $html .= '</section>';
            $html .= '</div>';

            return $html;
        }

    }

}
$seon_settings = new SEON_Settings();