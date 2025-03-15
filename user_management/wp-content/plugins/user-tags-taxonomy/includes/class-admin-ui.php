<?php
class Admin_UI {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_user_tags_menu'));
        add_action('show_user_profile', array($this, 'add_user_tags_field'));
        add_action('edit_user_profile', array($this, 'add_user_tags_field'));
        add_action('user_new_form', array($this, 'add_user_tags_field')); //  Add tags when creating a new user
        add_action('personal_options_update', array($this, 'save_user_tags'));
        add_action('edit_user_profile_update', array($this, 'save_user_tags'));
        add_action('user_register', array($this, 'save_user_tags')); //  Save tags for new users
        add_action('restrict_manage_users', array($this, 'add_user_tags_filter')); //  Custom Filter Dropdown
        add_filter('pre_get_users', array($this, 'filter_users_by_tags')); //  Apply Filter
        add_filter('manage_users_columns', array($this, 'add_user_tags_column')); //  Add user tags column
        add_action('manage_users_custom_column', array($this, 'populate_user_tags_column'), 10, 3);
    }

    public function add_user_tags_menu() {
        add_users_page(__('User Tags', 'textdomain'), __('User Tags', 'textdomain'), 'manage_options', 'edit-tags.php?taxonomy=user_tags');
    }

    public function add_user_tags_field($user) {
        $terms = get_terms(array('taxonomy' => 'user_tags', 'hide_empty' => false));
        $user_tags = is_object($user) ? wp_get_object_terms($user->ID, 'user_tags', array('fields' => 'ids')) : array();

        echo '<h3>' . __('User Tags', 'textdomain') . '</h3>';
        echo '<select name="user_tags[]" multiple style="width: 100%;">';
        foreach ($terms as $term) {
            // $selected = in_array($term->term_id, $user_tags) ? 'selected' : '';
            echo "<option value='{$term->term_id}' >{$term->name}</option>";
        }
        echo '</select>';
    }

    //  Ensure only valid tag IDs are assigned (prevents number-based tags from being created)
    public function save_user_tags($user_id) {
        if (isset($_POST['user_tags']) && is_array($_POST['user_tags'])) {
            $tag_ids = array_map('intval', $_POST['user_tags']); // Convert to valid term IDs
            $valid_tags = array_filter($tag_ids, function ($id) {
                return term_exists($id, 'user_tags'); // Only allow existing tags
            });

            wp_set_object_terms($user_id, $valid_tags, 'user_tags', false);
        }
    }

    public function add_user_tags_filter() {
        $screen = get_current_screen();
        if ($screen->id !== 'users') return;

        $terms = get_terms(array('taxonomy' => 'user_tags', 'hide_empty' => false));
        echo '<select name="filter_user_tags" id="filter_user_tags">';
        echo '<option value="all">' . __('Filter by User Tag', 'textdomain') . '</option>';
        foreach ($terms as $term) {
            $selected = (isset($_GET['filter_user_tags']) && $_GET['filter_user_tags'] == $term->term_id) ? 'selected' : '';
            echo "<option value='{$term->term_id}' {$selected}>{$term->name}</option>";
        }
        echo '</select>';
        submit_button(__('Filter'), 'secondary', 'filter_action', false, ['id' => 'filter-button']);
    } 
    
    public function filter_users_by_tags($query) {
        // if (!is_admin() || !$query->is_main_query()) {
        //     return;
        // }
    
        if (isset($_GET['filter_user_tags']) && !empty($_GET['filter_user_tags'])) {
            $tag_id = intval($_GET['filter_user_tags']);
            error_log("Filtering users by tag ID: " . $tag_id); // Debugging
    
            $user_ids = get_objects_in_term($tag_id, 'user_tags');
            if (!empty($user_ids)) {
                error_log("Users found: " . implode(',', $user_ids));
                $query->set('include', $user_ids);
            } else {
                error_log("No users found for this tag");
                $query->set('include', array(0)); // Show empty list if no users match
            }
            
        }
    
        // Debugging: Print query vars (Remove in production)
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log(print_r($query->query_vars, true));
        }
    }
    
    //  Add a column for User Tags in the Users list table
    public function add_user_tags_column($columns) {
        $columns['user_tags'] = __('User Tags', 'textdomain');
        return $columns;
    }

    //  Populate the User Tags column with assigned tags
    public function populate_user_tags_column($value, $column_name, $user_id) {
        if ($column_name === 'user_tags') {
            $terms = wp_get_object_terms($user_id, 'user_tags', array('fields' => 'names'));
            return !empty($terms) ? implode(', ', $terms) : '-';
        }
        return $value;
    }
}


