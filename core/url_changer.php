<?php

add_filter('login_headerurl', 'mlchanger_link_url',999);

function mlchanger_link_url() {
    $mlchanger_link_url = get_option('mlchanger_link_url',home_url());
    return $mlchanger_link_url;

}