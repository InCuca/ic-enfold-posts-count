<?php
/**
 * Plugin Name:     Enfold Posts Count
 * Plugin URI:      https://incuca.net
 * Description:     Enfold Plugin
 * Author:          INCUCA
 * Author URI:      https://incuca.net
 * Text Domain:     enfold_posts_count_plugin
 * Version:         0.1.0
 *
 * @package         Ic_Enfold
 */

// Add shortcodes to Enfold
add_filter('avia_load_shortcodes', 'enfold_colored_text_plugin_shortcodes', 12, 1);

function enfold_colored_text_plugin_shortcodes($paths)
{
	$plugin_dir = plugin_dir_path(__FILE__);
	array_push($paths, $plugin_dir.'/shortcodes/');
	return $paths;
}