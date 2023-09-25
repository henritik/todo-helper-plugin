<?php
/*
Plugin Name: Todo Helper Plugin 
Description: This helper plugin creates a new CPT "To-do" and various states as it's taxonomy terms. Meant to use with Headless To Do React App.
Version: 1.0
Requires PHP: 7.4
Author: Henri Tikkanen
Author URI: https://github.com/henritik/
License: License: GPLv2
Tested up to: WordPress 6.3.1
Text Domain: todo
*/

defined( 'ABSPATH' ) or die();

function todo_load_textdomain() {
	load_plugin_textdomain( 'todo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'todo_load_textdomain' );

// Initialize a new CPT "To-do"

function todo_create_cpt() {

	$labels = array (
		'name' 			=> __( 'To-do','post type general name', 'todo' ),
		'singular_name' 	=> __( 'To-do', 'post type singular name', 'todo' ),
		'name_admin_bar'	=> __( 'To-dos', 'todo' ),
		'add_new' 		=> __( 'Add new To-do', 'todo' ),
		'add_new_item' 		=> __( 'Add new To-do', 'todo' ),
		'edit_item' 		=> __( 'Edit To-do', 'todo' ),
		'new_item' 		=> __( 'New To-do', 'todo' ),
		'view_item' 		=> __( 'View To-do', 'todo' )
	);

	$args = array (
		'labels' 		=> $labels,
		'description'		=> 'To-do list',
		'public' 		=> true,
		'show_in_nav_menus' 	=> false,
		'menu_icon' 		=> 'dashicons-list-view',
		'supports' 		=> array( 'title' ),
		'show_in_rest' 		=> true
	);
	register_post_type( 'to-do', $args );
}
add_action( 'init', 'todo_create_cpt' );

// Initialize a new taxonomy "States" for todos

function todo_create_taxonomy() {
 
$labels = array(
	'name' => _x( 'States', 'taxonomy general name', 'todo' ),
	'singular_name' => _x( 'State', 'taxonomy singular name', 'todo' ),
	'search_items' =>  __( 'Search States', 'todo' ),
	'popular_items' => __( 'Popular States', 'todo' ),
	'all_items' => __( 'All States', 'todo' ),
	'parent_item' => null,
	'parent_item_colon' => null,
	'edit_item' => __( 'Edit State', 'todo' ), 
	'update_item' => __( 'Update State', 'todo' ),
	'add_new_item' => __( 'Add New State', 'todo' ),
	'new_item_name' => __( 'New State Name', 'todo' ),
	'separate_items_with_commas' => __( 'Separate states with commas', 'todo' ),
	'add_or_remove_items' => __( 'Add or remove states', 'todo' ),
	'choose_from_most_used' => __( 'Choose from the most used states', 'todo' ),
	'menu_name' => __( 'States', 'todo' ),
); 
 
register_taxonomy('states','to-do',array(
	'hierarchical' => false,
	'labels' => $labels,
	'show_ui' => true,
	'show_in_rest' => true,
	'show_admin_column' => true,
	'update_count_callback' => '_update_post_term_count',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'topic' ),
	));
}
add_action( 'init', 'todo_create_taxonomy' );
