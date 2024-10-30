<?php

include MLCHANGER_CORE_DIR . 'img_changer.php';
include MLCHANGER_CORE_DIR . 'url_changer.php';
include MLCHANGER_CORE_DIR . 'title_changer.php';
include MLCHANGER_CORE_DIR . 'message_changer.php';

$navbar_icon_status = get_option('mlchanger_navbar_icon',0);

if($navbar_icon_status) {
    include MLCHANGER_CORE_DIR . 'delete_navbar_icon.php';
}