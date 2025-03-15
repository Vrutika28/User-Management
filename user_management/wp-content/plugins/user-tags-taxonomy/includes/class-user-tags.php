<?php
class User_Tags {
    public function __construct() {
        add_action('init', array($this, 'register_user_tags_taxonomy'));
        add_action('init', array($this, 'assign_user_taxonomy'), 11);
    }

    public function register_user_tags_taxonomy() {
        register_taxonomy('user_tags', 'user', array(
            'label'        => __('User Tags', 'textdomain'),
            'rewrite'      => false,
            'public'       => false,
            'show_ui'      => true,
            'show_admin_column' => true,
            'hierarchical' => false,
        ));
    }

    public function assign_user_taxonomy() {
        global $wp_taxonomies;
        if (!empty($wp_taxonomies['user_tags'])) {
            $wp_taxonomies['user_tags']->object_type[] = 'user';
        }
    }
}

