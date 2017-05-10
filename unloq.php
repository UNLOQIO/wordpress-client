<?php
/*
Plugin Name: UNLOQ.io authentication
Plugin URI: https://unloq.io
Version: 1.5.8
Author: UNLOQ.io
Description: Perform UNLOQ.io authentications with the click of a button
*/
if (!defined('ABSPATH')) exit();
define( 'UNLOQ_PLUGIN_PATH', plugin_basename( __FILE__ ) );

require 'features/custom-login/unloq-custom-admin.php';
require 'features/custom-login-settings/unloq-custom-login-settings.php';
require 'features/restrict-login-user-role/unloq-login-filter-instance.php';

add_action('plugins_loaded', array('UnloqCustomAdmin', 'getInstance'), 1);
add_action('plugins_loaded', array('UnloqCustomAdminSettings', 'getInstance'), 1);
add_action('plugins_loaded', array('UnloqLoginFilterInstance', 'getInstance'), 1);


if (!defined('UNLOQ_BASE_PLUGIN')) define('UNLOQ_BASE_PLUGIN', true);
require_once('unloq-init.php');
add_action('init', 'unloq_start_session', 1);
function unloq_start_session() {
    if(!session_id()) {
        session_start();
    }
}
Unloq::start();

if( is_admin()) {
    require_once(UNLOQ_PATH . 'inc/class.settings.php');
    add_action('admin_menu', array('UnloqSettings', 'register_menu'));
}

/*// Require the setup script
require_once("inc/setup.php");
require_once("inc/api.class.php");
if( is_admin() ) {
    // Require the settings script.
    require_once("inc/settings.php");
}
require_once("inc/login.page.php");
// Register the custom paths
require_once("inc/uauth.php");

register_activation_hook(__FILE__, 'unloq_install_plugin');
register_deactivation_hook(__FILE__, 'unloq_deactivate_plugin');
register_uninstall_hook(__FILE__, 'unloq_uninstall_plugin');*/