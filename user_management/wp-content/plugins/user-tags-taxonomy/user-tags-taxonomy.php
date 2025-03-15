<?php
/**
 * Plugin Name: User Tags Taxonomy
 * Description: Adds a custom taxonomy "User Tags" to categorize users in WordPress.
 * Version: 1.0.0
 * Author: Vrutika Darji
 */

if (!defined('ABSPATH')) {
    exit;
}

function enqueue_select2_scripts() {
    wp_enqueue_style('admin-css',  plugin_dir_url(__FILE__) . 'assets/css/admin.css');
    wp_enqueue_script('custom-select2', plugin_dir_url(__FILE__) . 'assets/js/admin.js', array('jquery', 'select2'), '1.0', true);
    wp_localize_script('custom-select2', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php'), 'security' => wp_create_nonce('fetch_user_tags_nonce')));
}
add_action('admin_enqueue_scripts', 'enqueue_select2_scripts');
function custom_admin_script() {
    wp_enqueue_script('custom-admin-js', plugin_dir_url(__FILE__) . 'assets/js/admin.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'custom_admin_script');



// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/class-user-tags.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-admin-ui.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-ajax-handler.php';


// Initialize plugin classes
new User_Tags();
new Admin_UI();
new Ajax_Handler();
