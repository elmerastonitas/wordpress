<?php
defined('ABSPATH') || exit;

class WPAll_CustomLogin {
    public function __construct() {
        add_action('login_enqueue_scripts', array($this, 'custom_login_logo'));
        add_action('admin_enqueue_scripts', array($this, 'admin_assets'));
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_init', array($this, 'settings_init'));
        register_deactivation_hook(__FILE__, array($this, 'deactivation'));
        register_uninstall_hook(__FILE__, array($this, 'uninstall'));
    }

    public function custom_login_logo() {
        $options = get_option('custom_login_logo_settings');
        $logo_url = isset($options['custom_login_logo_url']) ? esc_url($options['custom_login_logo_url']) : '';
        
        if ($logo_url) {
            $logo_height = isset($options['custom_login_logo_height']) ? intval($options['custom_login_logo_height']) : 50;
            $logo_width = isset($options['custom_login_logo_width']) ? intval($options['custom_login_logo_width']) : 100;
            ?>
            <style type="text/css">
                #login h1 a,
                .login h1 a {
                    background-image: url('<?php echo $logo_url; ?>');
                    height: <?php echo $logo_height; ?>px;
                    width: <?php echo $logo_width; ?>px;
                    background-size: contain;
                    padding-bottom: 30px;
                    display: block;
                    text-indent: -9999px;
                }
            </style>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    var logoLink = document.querySelector('.login h1 a');
                    if (logoLink) {
                        logoLink.href = '<?php echo esc_url(home_url()); ?>';
                        logoLink.target = '_blank';
                        logoLink.title = '<?php esc_attr_e('Go to', 'wpall-customlogin'); ?> ' + '<?php echo esc_url(home_url()); ?>';
                        logoLink.setAttribute('aria-label', '<?php esc_attr_e('Go to', 'wpall-customlogin'); ?> ' + '<?php echo esc_url(home_url()); ?>');
                    }
                });
            </script>
            <?php
        }
    }

    public function admin_assets() {
        // Solo cargar en la página de configuración del plugin
        if (isset($_GET['page']) && $_GET['page'] === 'custom-login') {
            wp_enqueue_style('custom-login-admin-style', plugin_dir_url(__FILE__) . '../css/admin-style.css');
            wp_enqueue_media();
            wp_enqueue_script('custom-login-admin-script', plugin_dir_url(__FILE__) . '../js/admin-script.js', array('jquery'), null, true);
            wp_localize_script('custom-login-admin-script', 'wpcustomLoginScript', array(
                'chooseLogo' => __('Choose Logo', 'wpall-customlogin'),
                'removeLogo' => __('Remove Logo', 'wpall-customlogin'),
                'logoPreview' => __('Logo Preview', 'wpall-customlogin')
            ));
        }
    }

    public function admin_menu() {
        add_menu_page(
            __('Custom Login Settings', 'wpall-customlogin'),
            __('Custom Login', 'wpall-customlogin'),
            'manage_options',
            'custom-login',
            array($this, 'settings_page'),
            'dashicons-admin-generic'
        );
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('Custom Login Settings', 'wpall-customlogin'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('custom_login_logo_settings_group');
                do_settings_sections('custom_login');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function settings_init() {
        require_once plugin_dir_path(__FILE__) . 'custom-login-settings.php';
    }

    public function deactivation() {
        // Actions to perform on plugin deactivation
    }

    public function uninstall() {
        delete_option('custom_login_logo_settings');
    }
}
