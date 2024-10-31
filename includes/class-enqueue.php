<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('SEON_Enqueue')) {

    class SEON_Enqueue {

        public function __construct() {

            add_filter('admin_head', array(&$this, 'seon_include_css'));
            add_action('admin_enqueue_scripts', array(&$this, 'seon_include_admin_js'));

            session_start();

            if (!isset($_SESSION['seon_agent_session'])) {
                add_action('wp_loaded', array(&$this, 'seon_session_start'), 1);
                add_action('wp_enqueue_scripts', array(&$this, 'seon_include_js'));
            }
        }

        public function seon_include_css() {

            wp_enqueue_style('awesome_font', SEON_PLUGIN . '/assets/css/font-awesome.min.css');
            wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Cabin:400,500,600,700');

            wp_enqueue_style('admin-settings-styles', SEON_PLUGIN . '/assets/css/settings.css');
        }

        public function seon_include_admin_js() {
            wp_enqueue_script('seon_resizer', SEON_PLUGIN . '/assets/js/iframeResizer.min.js', array(), '1.0.0', true);
            wp_enqueue_script('seon_js', SEON_PLUGIN . '/assets/js/scripts.js', array('jquery'), '1.0.0', true);
        }

        public function seon_include_js() {
            $seon_settings_agent = ( get_option('seon_activate_agent') ? get_option('seon_activate_agent') : get_site_option('seon_activate_agent') );
            if ($seon_settings_agent) {
                wp_enqueue_script('jquery');
                wp_enqueue_script('seon_agent', 'https://cdn.seon.io/v2.0/js/agent.js', array('jquery'), '1.0.0', true);
                wp_enqueue_script('seon_agent_js', SEON_PLUGIN . '/assets/js/agent.js', array('jquery', 'seon_agent'), '1.0.0', true);

                $seon_js_vars = array('session_id' => ( isset($_SESSION['seon_agent_session']) ? $_SESSION['seon_agent_session'] : '' ));
                wp_localize_script('seon_agent_js', 'SEON_VARS', $seon_js_vars);
            }
        }

        public function seon_session_start() {
            $random_number = $this->seon_create_session();
            $_SESSION['seon_agent_session'] = ( isset($_SESSION['seon_agent_session']) ? $_SESSION['seon_agent_session'] : $random_number );
        }

        public function seon_create_session() {
            return md5(mt_rand(10000, 99999));
        }

    }

}
$seon_enqueue = new SEON_Enqueue();
