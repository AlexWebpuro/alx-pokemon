<?php

/*
 * @package Pokemon
 */

namespace Inc\Base;

class Templates extends BaseController {

    public function register() {
        add_filter( 'single_template', array( $this, 'load_single' ) );
    }

    public function load_single( $template ) {
        global $post;
    
        if ( 'pokemon' === $post->post_type && locate_template( array( 'single-movie.php' ) ) !== $template ) {
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
}
