<?php
/**
 * Plugin Name: AUser Role Sub Admin
 * Description: 1) Should not be able to change post slug. 2) Should not be able to modify post publish date.
 * Version: 1.0
 * Author: Your Name
 */

function enqueue_custom_css() {
    if (current_user_can('sub_admin')) {
        wp_enqueue_style('custom-css', plugin_dir_url(__FILE__) . 'custom-css.css');
    }
}
add_action('admin_enqueue_scripts', 'enqueue_custom_css');

function register_custom_sub_admin_role() {
    $capabilities = get_role('administrator')->capabilities;

    add_role('sub_admin', 'Sub Admin', $capabilities);
}
register_activation_hook(__FILE__, 'register_custom_sub_admin_role');

function remove_custom_sub_admin_role() {
    remove_role('sub_admin');
}
register_deactivation_hook(__FILE__, 'remove_custom_sub_admin_role');