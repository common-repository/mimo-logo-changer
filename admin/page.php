<?php

add_action('admin_enqueue_scripts','mlchanger_load_css');

function mlchanger_load_css() {
    wp_register_style('mlchanger_style', MLCHANGER_CSS_URL . 'mlchanger_css.css');
    wp_enqueue_style('mlchanger_style');

    wp_register_script('mlchanger_js', MLCHANGER_JS_URL . 'mlchanger_js.js');
    wp_enqueue_script('mlchanger_js');

}


function mlchanger_func() {
    include MLCHANGER_TPL_DIR . 'main-page-html.php';
    
}

function mlchanger_setting_func() {
    // Controller

    // Reset Setting
    if(isset($_POST['lc_reset_setting'])) {
        wp_verify_nonce($_POST['mlchanger_nonce'], 'mlchanger_reset_setting') || wp_die('خطای csrf');
        // Reset Setting
        update_option('mlchanger_img_url', null);
        update_option('mlchanger_img_width', null);
        update_option('mlchanger_img_height', null);
        update_option('mlchanger_link_url', null);
        update_option('mlchanger_img_title', null);
        update_option('mlchanger_login_message', null);
        update_option('mlchanger_navbar_icon', null);
        update_option('mlchanger_custom_html_message_bool', null);
        update_option('mlchanger_custom_html_message', null);
        

        include MLCHANGER_TPL_DIR . 'setting-page-html.php';
        return true;
    }

    // Save Setting
    if(isset($_POST['submit'])) {
        wp_verify_nonce($_POST['mlchanger_nonce'], 'mlchanger_save_setting') || wp_die('خطای csrf');
        
        update_option('mlchanger_img_url',sanitize_text_field($_POST['mlchanger_img_url']));
        update_option('mlchanger_img_width',sanitize_text_field($_POST['mlchanger_img_width']));
        update_option('mlchanger_img_height',sanitize_text_field($_POST['mlchanger_img_height']));

        update_option('mlchanger_link_url',sanitize_text_field($_POST['mlchanger_link_url']));
        update_option('mlchanger_img_title',sanitize_text_field($_POST['mlchanger_img_title']));

        
        update_option('mlchanger_navbar_icon', isset($_POST['mlchanger_navbar_icon']) ? 1 : 0);
        
        isset($_POST['mlchanger_login_message']) ? update_option('mlchanger_login_message',sanitize_text_field($_POST['mlchanger_login_message'])) : null;
        update_option('mlchanger_custom_html_message_bool', isset($_POST['mlchanger_custom_html_message_bool']) ? 1 : 0);
        update_option('mlchanger_custom_html_message',stripslashes($_POST['mlchanger_custom_html_message']));

    }
    
    // Load View
    include MLCHANGER_TPL_DIR . 'setting-page-html.php';
}

