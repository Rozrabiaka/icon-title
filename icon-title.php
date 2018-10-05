<?php
/*
Plugin Name: Icon Title
Description: Choose icon for your Title on your post/products pages
Author: Denys Maksiura
Version: 1.0.0
*/

define('ICON_TITLE_DIR', plugin_dir_path(__FILE__));
define('ICON_TITLE_ADMIN_DIR', trailingslashit(plugin_dir_url(__FILE__) . 'admin'));
define('ICON_TITLE_VERSION', '1.0.0');
define('ICON_TITLE_URL', plugin_dir_url(__FILE__));

//activate plugin
function activate_icon_title()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-icon-title-activator.php';
    Icon_Title_Activator::activate();
}

//deactivate plugin
function deactivate_icon_title()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-icon-title-deactivator.php';
    Icon_Title_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_icon_title' );
register_deactivation_hook( __FILE__, 'deactivate_icon_title' );

include ICON_TITLE_DIR.'includes/class-icon-title.php';
Icon_Title::init();
?>