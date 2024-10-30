<?php

/*
Plugin Name: MIMO WP logo changer
Plugin URI: http://mimowp.ir/logo-changer
Description: با استفاده از این افزونه میتوانید لوگو و لینک تصویر صفحه ورود وردپرس را تغییر دهید.
Version: 1.3
Author: MiMo
Author URI: https://mimowp.ir
*/

//define('MLCHANGER_DB_VERSION',1);

defined('ABSPATH') || exit('No direct.');

define('MLCHANGER_PATH', plugin_dir_path(__FILE__));
define('MLCHANGER_URL', plugin_dir_url(__FILE__));

define('MLCHANGER_ADMIN_DIR', trailingslashit(MLCHANGER_PATH . 'admin'));
define('MLCHANGER_TPL_DIR', trailingslashit(MLCHANGER_PATH . 'templates'));
define('MLCHANGER_CORE_DIR', trailingslashit(MLCHANGER_PATH . 'core'));

define('MLCHANGER_CSS_URL', trailingslashit(MLCHANGER_URL . 'assets/css'));
define('MLCHANGER_JS_URL', trailingslashit(MLCHANGER_URL . 'assets/js'));
define('MLCHANGER_IMG_URL', trailingslashit(MLCHANGER_URL . 'assets/img'));


if(is_admin()) {
    include MLCHANGER_ADMIN_DIR . 'page.php';
    include MLCHANGER_ADMIN_DIR . 'menu.php';
}

include MLCHANGER_CORE_DIR . 'autoload.php';
