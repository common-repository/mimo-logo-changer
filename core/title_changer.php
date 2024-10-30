<?php


global $wp_version;
$mlchanger_wp_ver = str_replace('.','',$wp_version);

// Wordpress > 5.2
add_filter('login_headertext', 'mlchanger_img_title',999);

function mlchanger_img_title() {
    $mlchanger_img_title = get_option('mlchanger_img_title', get_bloginfo('name'));
    return $mlchanger_img_title;

}