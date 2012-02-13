<?php
/*
	Plugin Name: Literate Programming
	Plugin URI: http://weblog.benjaminsommer.com/literate-programming/
	Description: Use literate programming when publishing source code to greatly increase code understanding. It should be used whenever gradually introducing and explaining source code fragments. Styling and reference checking is automatically done.
	Author: Benjamin Sommer
	Version: 1.0
	Author URI: http://benjaminsommer.com
	License: CC GNU GPL 2.0 license
	Text Domain: lppress
 */

/* 
 * The root file for this plugin
 * Used coding standard suggested by Zend Framework (http://framework.zend.com/manual/en/coding-standard.html)
 */

//---------------------------------------------------------------------------------------------------------
// SETUP REQUIRED DEPENDENCIES AND FEATURES
//---------------------------------------------------------------------------------------------------------

define('LP_PATH', dirname(__FILE__) . '');
define('LP_API', dirname(__FILE__) . '/LP');

require 'LP/Init.php';

register_activation_hook(__FILE__, 'LP_Init::activate');
register_deactivation_hook(__FILE__, 'LP_Init::deactivate');
register_uninstall_hook(__FILE__, 'LP_Init::uninstall');

LP_Init::exec();

$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'lppress', false, $plugin_dir.'/i18n/' );

?>