<?php

/*
 * @package Pokemon
 */

namespace Inc\Base;

class Enqueue extends BaseController {
    public function register() {
       add_action('wp_enqueue_scripts', array( $this, 'enqueue' ) );
       add_action("wp_ajax_pokedex", array( $this, "ajax_pokedex" ) );
       add_action("wp_ajax_nopriv_pokedex", array( $this, "ajax_pokedex" ) );
    }

    public function enqueue() {
        if( ! is_singular( 'pokemon' ) ) return;

        // Load pokemon styles
        $css = $this->plugin_url.'assets/pokemon.css';
        wp_enqueue_style('alx-pokemon', $css, array(), '1.0', 'all' );

        // Load Bootstrap
        $bootstrap = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css';
        wp_enqueue_style('alx-bootstrap', $bootstrap, array(), '', 'all' );

        // Pokemon font
        $pokemon_font = 'https://fonts.cdnfonts.com/css/pokemon-solid';
        wp_enqueue_style('pokemon', $pokemon_font, array(), '1.0', 'all' );

        // Load pokemon javascript
        $js = $this->plugin_url.'assets/main.js';
        wp_enqueue_script( 'pokemon', $js, array(), '1.0.0', true );

        wp_localize_script('pokemon', 'pokemon_vars', array( 'ajax_url' => admin_url('admin-ajax.php')));
    }

    function ajax_pokedex() {
        if( isset( $_POST['post_id']) && ! empty( $_POST['post_id'] ) ) {
            $post_id = $_POST['post_id'];
            $pokedex = get_post_meta( $post_id, '_pokemon_pokedex_orlder_number', true );
            echo json_encode( $pokedex );
        }
        wp_die();
    }
}