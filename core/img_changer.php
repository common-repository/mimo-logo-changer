<?php

add_action('login_head', 'mlchanger_img_src',999);

function mlchanger_img_src() {
    
    $mlchanger_img_url = get_option('mlchanger_img_url');
    
    $mlchanger_logo_width = get_option('mlchanger_img_width');

    $mlchanger_logo_height = get_option('mlchanger_img_height');

    $mlchanger_logo_margin = 'auto';
    if($mlchanger_logo_width > 320) {
        $mlchanger_logo_margin = ($mlchanger_logo_width - 320) / 2;
    }

    echo '
    <style type="text/css">
    .login h1 a { 
            background-image:url('.$mlchanger_img_url.') !important; 
            background-size:'.$mlchanger_logo_width.'px '.$mlchanger_logo_height .'px; 
            height:'.$mlchanger_logo_height .'px; width:'.$mlchanger_logo_width.'px;
            margin: 0 -'.$mlchanger_logo_margin .'px;
    }

    .login .message {
    display: none;
    }	
    </style>';
}