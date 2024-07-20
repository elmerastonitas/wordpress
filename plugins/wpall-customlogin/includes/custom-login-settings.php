<?php
defined('ABSPATH') || exit;

function custom_login_logo_settings_init() {
    register_setting(
        'custom_login_logo_settings_group',
        'custom_login_logo_settings',
        'custom_login_logo_sanitize'
    );

    add_settings_section(
        'custom_login_logo_section',
        __('Custom Logo Settings', 'wpall-customlogin'),
        'custom_login_logo_section_callback',
        'custom_login'
    );

    add_settings_field(
        'custom_login_logo_url',
        __('Logo URL', 'wpall-customlogin'),
        'custom_login_logo_url_callback',
        'custom_login',
        'custom_login_logo_section'
    );

    add_settings_field(
        'custom_login_logo_width',
        __('Logo Width (px)', 'wpall-customlogin'),
        'custom_login_logo_width_callback',
        'custom_login',
        'custom_login_logo_section'
    );

    add_settings_field(
        'custom_login_logo_height',
        __('Logo Height (px)', 'wpall-customlogin'),
        'custom_login_logo_height_callback',
        'custom_login',
        'custom_login_logo_section'
    );
}
add_action('admin_init', 'custom_login_logo_settings_init');

function custom_login_logo_section_callback() {
    _e('Enter the settings for the custom login logo below.', 'wpall-customlogin');
}

function custom_login_logo_url_callback() {
    $options = get_option('custom_login_logo_settings');
    ?>
    <input type="hidden" id="custom_login_logo_url" name="custom_login_logo_settings[custom_login_logo_url]" value="<?php echo isset($options['custom_login_logo_url']) ? esc_attr($options['custom_login_logo_url']) : ''; ?>" />
    <button id="upload_logo_button" class="button"><?php _e('Upload/Select Logo', 'wpall-customlogin'); ?></button>
    <button id="remove_logo_button" class="button"><?php _e('Remove Logo', 'wpall-customlogin'); ?></button>
    <div id="logo_preview">
        <?php if (isset($options['custom_login_logo_url']) && $options['custom_login_logo_url']): ?>
            <img src="<?php echo esc_url($options['custom_login_logo_url']); ?>" alt="<?php _e('Logo Preview', 'wpall-customlogin'); ?>" style="max-width: 100px; height: auto;" />
        <?php endif; ?>
    </div>
    <p class="description"><?php _e('Upload or select an image from the media library for the custom login logo.', 'wpall-customlogin'); ?></p>
    <?php
}

function custom_login_logo_height_callback() {
    $options = get_option('custom_login_logo_settings');
    ?>
    <input type="number" id="custom_login_logo_height" name="custom_login_logo_settings[custom_login_logo_height]" value="<?php echo isset($options['custom_login_logo_height']) ? esc_attr($options['custom_login_logo_height']) : 50; ?>" />
    <p class="description"><?php _e('Enter the height of the logo in pixels.', 'wpall-customlogin'); ?></p>
    <?php
}

function custom_login_logo_width_callback() {
    $options = get_option('custom_login_logo_settings');
    ?>
    <input type="number" id="custom_login_logo_width" name="custom_login_logo_settings[custom_login_logo_width]" value="<?php echo isset($options['custom_login_logo_width']) ? esc_attr($options['custom_login_logo_width']) : 100; ?>" />
    <p class="description"><?php _e('Enter the width of the logo in pixels.', 'wpall-customlogin'); ?></p>
    <?php
}

function custom_login_logo_sanitize($input) {
    $sanitized_input = array();
    if (isset($input['custom_login_logo_url'])) {
        $sanitized_input['custom_login_logo_url'] = esc_url_raw($input['custom_login_logo_url']);
    }
    if (isset($input['custom_login_logo_height'])) {
        $sanitized_input['custom_login_logo_height'] = absint($input['custom_login_logo_height']);
    }
    if (isset($input['custom_login_logo_width'])) {
        $sanitized_input['custom_login_logo_width'] = absint($input['custom_login_logo_width']);
    }
    return $sanitized_input;
}
