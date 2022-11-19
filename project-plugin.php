<?php
/**
 * @package ProjectPlugin
 */
/*
 Plugin Name: Project Plugin
 Plugin URI:
 Description: A Project Development for Wordpress
 Version: 0.0.1
 Author: Kirk Garcia
 Author URI: https://www.linkedin.com/in/kirk-jann-garcia-baba97113/
 License: GPL v3 or later
 License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 */

 //security check
 defined( 'ABSPATH' ) or die ( 'You cannot access this file' );

 //activation
function activate_project_plugin() {
    Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_project_plugin' );

 //deactivation
 function deactivate_project_plugin() {
    Inc\Base\Deactivate::deactivate();
 }
 register_deactivation_hook( __FILE__, 'deactivate_project_plugin' );