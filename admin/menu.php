<?php

add_action('admin_menu','mlchanger_menu');

function mlchanger_menu() {
    $menu = add_menu_page('تغییر لوگو وردپرس', 'تغییر لوگو وردپرس', 'manage_options', 'mimo_logo_changer','mlchanger_setting_func','dashicons-admin-appearance');
    add_submenu_page('lc', 'تغییر لوگو وردپرس', 'تغییر لوگو وردپرس', 'manage_options', 'mlchanger_setting','mlchanger_setting_func');

}