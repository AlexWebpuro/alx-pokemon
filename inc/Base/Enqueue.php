<?php

/*
 * @package Pokemon
 */

namespace Inc\Base;

class Enqueue extends BaseController {
    public function register() {
       add_action('wp_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    public function enqueue() {
        if( ! is_singular( 'pokemon' ) ) return;
        $css = $this->plugin_url.'assets/pokemon.css';
        wp_enqueue_style('alx-pokemon', $css, array(), '1.0', 'all' );

        $bootstrap = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css';
        wp_enqueue_style('alx-bootstrap', $bootstrap, array(), '', 'all' );

        // Pokemon font
        $pokemon_font = 'https://fonts.cdnfonts.com/css/pokemon-solid';
        wp_enqueue_style('pokemon', $pokemon_font, array(), '1.0', 'all' );
    }
}