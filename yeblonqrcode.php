<?php
/*
Plugin Name: Yeblon QR Code Generator
Plugin URI: http://yeblon.com/qr-code-generator-wordpress-plugin
Version: 1.1
Author: Yeblon
Author URI: http://yeblon.com
Description: QR Code Generator
*/

/* Main function */
function yeblonqrcode($arg) {
$current_uri = 'http://'.$_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI].'';	
	if ($arg == ""){
		$arg = 100;
	}
	
	echo '<img src="https://chart.googleapis.com/chart?chs='.$arg.'x'.$arg.'&cht=qr&chl='.$current_uri.'&chld=L|1&choe=UTF-8" width="'.$arg.'" 
	height="'.$arg.'" title="'.$current_uri.'" alt="'.$current_uri.'" id="yeblonqrcode" />';
}

/* Shortcode function */
function yeblonqrcode_shortcode($atts) {
	
     extract(shortcode_atts(array(
	      'size' => '100',
		  'url' => 'current',
	      'class' => 'yeblonqrcode',
	      'style' => '',
     ), $atts));
	
	if ($size == ""){
		$size = 100;
	}
	if ($size < 30){
		$size = 30;
	}
	
	if ($url == ""){
		$url = get_permalink();
	}

	if ($class == ""){
		$class = '';
	} else {
		$class = 'class="'.$class.'"';
	}
	
	if ($style == ""){
		$style = '';
	} else {
		$style = 'style="'.$style.'"';
	}
	
	return '<img src="https://chart.googleapis.com/chart?chs='.$size.'x'.$size.'&cht=qr&chl='.$url.'&chld=L|1&choe=UTF-8" width="'.$size.'" id="yeblonqrcode" height="'.$size.'" title="'.$url.'" alt="'.$url.'" '.$class.' '.$style.' />';
}

/* Add Shortcode */
add_shortcode('yeblonqrcode', 'yeblonqrcode_shortcode');

/* Add TinyMCE plugin */
add_filter('mce_external_plugins', "yeblonqrcodeplugin_register");
add_filter('mce_buttons', 'yeblonqrcode_add_button', 0);

function yeblonqrcode_add_button($buttons)
{
    array_push($buttons, "separator", "yeblonqrcodeplugin");
    return $buttons;
}
function yeblonqrcodeplugin_register($plugin_array)
{
    $url = get_bloginfo('url')."/wp-content/plugins/yeblon-qr-code-generator/tinymce/yeblonqrcode.js";
    $plugin_array["yeblonqrcodeplugin"] = $url;
    return $plugin_array;
}

/* Add Widget */
function init_qrcode(){
	register_sidebar_widget("QR Code", "qrcode_widget");     
}
function qrcode_widget() {
$current_uri = 'http://'.$_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI].'';
	echo '<div style="text-align: center!important;"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl='.$current_uri.'&chld=L|1&choe=UTF-8" width="100" height="100" title="'.$current_uri.'" alt="'.$current_uri.'" id="yeblonqrcode" /></div><br />';
}
add_action("plugins_loaded", "init_qrcode");
?>