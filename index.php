<?php
/*
 * Plugin Name: Easy Simple Contact Form
 * Plugin URI:  https://dialadoorsmelbourne.com.au/
 * Description: This is a very simple contact form with form validation. Use shortcode to display form on page or use the widget to dispaly contact form in sidebar.
 * Version: 1.0
 * Author: Dial A Door
 * Author URI: https://dialadoorsmelbourne.com.au/
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// enqueues plugin scripts
function cform_scripts() {	
	if(!is_admin())	{
		wp_enqueue_style('main-style', plugins_url('/css/main-style.css',__FILE__));
	}
}
add_action('wp_enqueue_scripts', 'cform_scripts');


// the sidebar widget
function register_cform_widget() {
	register_widget( 'cform_widget' );
}
add_action( 'widgets_init', 'register_cform_widget' );


// function to get ip of user
function cform_get_the_ip() {
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	else {
		return $_SERVER["REMOTE_ADDR"];
	}
}


// include form and widget files
include 'cform-form.php';
include 'cform-widget-form.php';
include 'cform-widget.php';

?>