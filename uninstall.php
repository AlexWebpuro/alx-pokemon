<?php

/*
 * @package Pokemon
 * @wordpress-plugin
 */


 if( ! defined( 'WP_UNINSTALL_PLUGIN' )) {
    die;
 }

 $pokemons = get_posts( array( 'post_type' => 'pokemon', 'numberpost' => -1 ) );

 foreach( $pokemons as $pokemon ) {
    wp_delete_post( $pokemon->ID, false );
 }