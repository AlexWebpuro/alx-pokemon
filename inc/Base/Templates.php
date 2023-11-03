<?php

/*
 * @package Pokemon
 */

namespace Inc\Base;

class Templates extends BaseController {

    public function register() {
        add_filter( 'single_template', array( $this, 'load_single' ) );
        // add_filter( 'archive_template', array( $this, 'load_archive' ) );
    }

    public function load_single( $template ) {
        global $post;
    
        if ( 'pokemon' === $post->post_type && locate_template( array( 'single-pokemon.php' ) ) !== $template ) {
            /*
             * This is a 'movie' post
             * AND a 'single movie template' is not found on
             * theme or child theme directories, so load it
             * from our plugin directory.
             */
            return $this->plugin_path . 'templates/single-pokemon.php';
        }
    
        return $template;
    }

    public function load_archive( $template ) {
        global $post;
        dump( $post );
        if ( 'pokemon' === $post->post_type && locate_template( array( 'archive-pokemon.php' ) ) !== $template ) {
            /*
             * This is a 'movie' post
             * AND a 'single movie template' is not found on
             * theme or child theme directories, so load it
             * from our plugin directory.
             */
            return $this->plugin_path . 'templates/archive-pokemon.php';
        }
    
        return $template;
    }
}
