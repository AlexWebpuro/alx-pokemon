<?php

/*
 * @package Pokemon
 */

namespace Inc\CPT;

use Inc\CustomFields\PokemonCustomField;

class Pokemon {

    public function register() {
        add_action('init', array( $this, 'custom_post_type' ) );
        $custom_field = new PokemonCustomField();
        $custom_field->register();
    }

    public function custom_post_type() {

        // Register Custom Post Type
        $labels = array(
            'name'                  => _x( 'Pokemon', 'Post Type General Name', 'alex_monroy' ),
            'singular_name'         => _x( 'Pokemon', 'Post Type Singular Name', 'alex_monroy' ),
            'menu_name'             => __( 'Pokemon', 'alex_monroy' ),
            'name_admin_bar'        => __( 'Pokemon', 'alex_monroy' ),
            'archives'              => __( 'Item Archives', 'alex_monroy' ),
            'attributes'            => __( 'Item Attributes', 'alex_monroy' ),
            'parent_item_colon'     => __( 'Parent Item:', 'alex_monroy' ),
            'all_items'             => __( 'All Items', 'alex_monroy' ),
            'add_new_item'          => __( 'Add New Item', 'alex_monroy' ),
            'add_new'               => __( 'Add New Pokemon', 'alex_monroy' ),
            'new_item'              => __( 'New Item', 'alex_monroy' ),
            'edit_item'             => __( 'Edit Item', 'alex_monroy' ),
            'update_item'           => __( 'Update Item', 'alex_monroy' ),
            'view_item'             => __( 'View Item', 'alex_monroy' ),
            'view_items'            => __( 'View Items', 'alex_monroy' ),
            'search_items'          => __( 'Search Item', 'alex_monroy' ),
            'not_found'             => __( 'Not found', 'alex_monroy' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'alex_monroy' ),
            'featured_image'        => __( 'Featured Image', 'alex_monroy' ),
            'set_featured_image'    => __( 'Set featured image', 'alex_monroy' ),
            'remove_featured_image' => __( 'Remove featured image', 'alex_monroy' ),
            'use_featured_image'    => __( 'Use as featured image', 'alex_monroy' ),
            'insert_into_item'      => __( 'Insert into item', 'alex_monroy' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'alex_monroy' ),
            'items_list'            => __( 'Items list', 'alex_monroy' ),
            'items_list_navigation' => __( 'Items list navigation', 'alex_monroy' ),
            'filter_items_list'     => __( 'Filter items list', 'alex_monroy' ),
        );
        $args = array(
            'label'                 => __( 'Pokemon', 'alex_monroy' ),
            'description'           => __( 'Pokemon', 'alex_monroy' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'pokemon', $args );
    }
}