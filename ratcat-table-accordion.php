<?php
/*
Plugin Name: RATCAT Table Accordion
Plugin URI: http://teamratcat.biz/ratcat-table-accordion/
Description: This plugin will help you to make a table look accordion as well as you might use it to make single column accordion too with or without image.
Author: Team RATCAT
Author URI: http://teamratcat.biz
Version: 1.0.0
*/

/* Adding Latest jQuery from Wordpress */
function ratcat_table_accordion_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'ratcat_table_accordion_latest_jquery');

define('RATCAT_TABLE_ACCORDION', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

wp_enqueue_script('ratcat-table-accordion-active', RATCAT_TABLE_ACCORDION.'js/tabacc.js', array('jquery'));

wp_enqueue_style('ratcat-table-accordion-style', RATCAT_TABLE_ACCORDION.'css/style.css');
/* Generates Shortcode */
function table($atts, $content = null) {
	return ('<div class="page-wrap">'.do_shortcode($content).'</div><div style="clear: both;"></div>');
}
add_shortcode ("table", "table");
function head($atts, $content = null) {
	$url = plugins_url( 'ratcat-table-accordion/images/ratcat.jpg' , dirname(__FILE__) );
	extract( shortcode_atts( array(
		'color' => '#333',
		'banner' => 'visible',
		'subject' => 'Subject',
		'image' => $url,
	), $atts ) );
	return "<div class='gridacc'><h2 style='background:{$color}'>{$subject}</h2><div class='photo' style='display: {$banner}ne'><img src='{$image}'></div><dl>".do_shortcode($content)."</dl></div>";
}
add_shortcode ("head", "head");
function data( $atts) {
	extract( shortcode_atts( array(
		'color' => '#FE3232',
		'title' => 'Title',
		'detail' => 'Details goes here........',
	), $atts ) );
	return "<dt style='background:{$color}'>{$title}</dt><dd style='background:{$color}'>{$detail}</dd>";
}
add_shortcode( 'data', 'data' );
/* Add Slider Shortcode Button on Post Visual Editor */
function onekbslider_button() {
	add_filter ("mce_external_plugins", "slider_button_js");
	add_filter ("mce_buttons", "slider_button");
}
function slider_button_js($plugin_array) {
	$plugin_array['wptuts'] = plugins_url('js/custom-button.js', __FILE__);
	return $plugin_array;
}
function slider_button($buttons) {
	array_push ($buttons, 'table', 'head', 'data');
	return $buttons;
}
add_action ('init', 'onekbslider_button'); 
?>