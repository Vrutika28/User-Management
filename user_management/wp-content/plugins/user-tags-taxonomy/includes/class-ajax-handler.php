<?php
class Ajax_Handler {
    public function __construct() {
        add_action('wp_ajax_fetch_user_tags', array($this, 'fetch_user_tags'));
        add_action('wp_ajax_nopriv_fetch_user_tags', array($this, 'fetch_user_tags')); // Allow for non-logged-in users (optional)
    }

    public function fetch_user_tags() {
      
        // Sanitize the search query
        $query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';

        // Fetch user tags
        $terms = get_terms(array(
            'taxonomy'   => 'user_tags',
            'hide_empty' => false,
            'search'     => $query
        ));

        if (is_wp_error($terms)) {
            wp_send_json_error(array('message' => 'Error fetching tags'), 500);
        }

        // Prepare results
        $results = array();
        if (!empty($terms)) {
            foreach ($terms as $term) {
                $results[] = array('id' => $term->term_id, 'text' => $term->name);
            }
        }

        wp_send_json_success($results);
    }
}

new Ajax_Handler();
