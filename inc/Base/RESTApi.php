<?php

/*
 * @package Pokemon
 */

namespace Inc\Base;

class RESTApi {
    public function register() {
        add_action( 'rest_api_init', array( $this, 'pokemon_api' ) );
    }
    
    public function pokemon_api() {
        register_rest_route( 'pk/v1', 'pokedex', array( 'method' => 'GET', 'callback' => array( $this, 'pokedex_info' ) ) );
        register_rest_route( 'pk/v1', 'pokemon', array( 'method' => 'GET', 'callback' => array( $this, 'pokemon_info' ) ) );
    }

    public function pokedex_info() {
        $arg = array(
            'postnumber' => -1,
            'post_type'	=> 'pokemon'
        );
    
        $posts = get_posts( $arg );
    
    
        $data = array();
        $i = 0;
    
        foreach( $posts as $post ) {
            $data[$i]['pokedex_recent_number']  = get_post_meta( $post->ID, '_pokemon_pokedex_recent_number', true );
            $data[$i]['name']                   = $post->post_title;
            $i++;
        }
        return $data;
    }

    public function pokemon_info() {
        $arg = array(
            'postnumber' => -1,
            'post_type'	=> 'pokemon'
        );

        $posts = get_posts( $arg );


        $data = array();
        $i = 0;

        foreach( $posts as $post ) {
            $data[$i]['name'] 					= $post->post_title;
            $data[$i]['description']			= $post->post_content;
            $data[$i]['weight'] 				= get_post_meta( $post->ID, '_pokemon_weight', true );
            $data[$i]['type'] 					= get_post_meta( $post->ID, '_pokemon_type', true );
            $data[$i]['pokedex_recent_number'] 	= get_post_meta( $post->ID, '_pokemon_pokedex_recent_number', true );
            $data[$i]['pokedex_old_number'] 	= get_post_meta( $post->ID, '_pokemon_pokedex_orlder_number', true );
            $data[$i]['image'] 					= get_the_post_thumbnail_url( $post->ID, 'full' );
            $i++;
        }
        return $data;
    }

}