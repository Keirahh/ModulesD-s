<?php
/*
Plugin Name: rollDice
Description: Module de lancemant de dés
Author: Sophie
Version: 0.0.1
*/

include_once plugin_dir_path(__FILE__)."/rollDice.class.php";

register_activation_hook(__FILE__, array('rollDice_Widget', 'install'));
register_uninstall_hook(__FILE__, array('rollDice_Widget', 'uninstall'));

add_action('widgets_init', function(){ if(is_user_logged_in()) { register_widget('rollDice_Widget');}});


add_action('init', array('rollDice_Widget', 'traitement'));