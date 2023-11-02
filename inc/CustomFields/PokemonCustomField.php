<?php

/*
 * @package Pokemon
 */

namespace Inc\CustomFields;

class PokemonCustomField {

    public function register() {
        $this->add_metabox('pokemon');
        add_action( 'save_post_pokemon', array( $this, 'save' ) );
    }

    public function add_metabox( $post_type ) {
        add_action( "add_meta_boxes_$post_type", array( $this, 'add_meta_boxes' ) );
    }

    public function add_meta_boxes( $post ) {

        add_meta_box( 'pokemon_info', __( 'Pokemon info', 'alex_monroy' ), array( $this, 'build_meta_box'), 'pokemon', 'normal', 'low' );
        // add_meta_box( $args['pokemon_info'], __( 'Pokemon info', 'alex_monroy' ), 'pokemon_build_meta_box', 'pokemon', 'normal', 'low' );
        // add_meta_box( $args['id'], $args['title'], $args['callback'], $args['screen'], $args['position'], $args['priority'] );
    }

    public function build_meta_box( $post ) {
        wp_nonce_field( basename( __FILE__ ), 'pokemon_meta_box_nonce' );
	
        $pokemon_weight = get_post_meta( $post->ID, '_pokemon_weight', true);
        $pokemon_type = implode(',', get_post_meta( $post->ID, '_pokemon_type', true));
        $pokemon_pokedex_orlder_number = get_post_meta( $post->ID, '_pokemon_pokedex_orlder_number', true);
        $pokemon_pokedex_recent_number = get_post_meta( $post->ID, '_pokemon_pokedex_recent_number', true);
    
        ?>
        <div class="inside">
            <span><?php echo __('About Pokemon', 'alex_monroy' ); ?></span>
            <p>
                <label for="pokemon_weight">
                    Weight
                    <input type="text" name="pokemon_type" value="<?php echo $pokemon_type ?>">
                </label>
                <label for="pokemon_weight">
                    Type
                    <input type="text" name="pokemon_weight" value="<?php echo $pokemon_weight ?>">
                </label>
                <label for="pokemon_pokedex_orlder_number">
                    Pokedex older number
                    <input type="number" name="pokemon_pokedex_orlder_number" value="<?php echo $pokemon_pokedex_orlder_number ?>">
                </label>
                <label for="pokemon_pokedex_recent_number">
                    Pokedex recent number
                    <input type="number" name="pokemon_pokedex_recent_number" value="<?php echo $pokemon_pokedex_recent_number ?>">
                </label>
            </p>
        </div>
        <?php
    }

    public function save( $post_id ) {
        if ( !isset( $_POST['pokemon_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['pokemon_meta_box_nonce'], basename( __FILE__ ) ) ){
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ){
            return;
        }
    
        $inputs = array( 'pokemon_weight', 'pokemon_type', 'pokemon_pokedex_orlder_number', 'pokemon_pokedex_recent_number' );
    
        foreach( $inputs as $input ) {
            
            if( isset( $_REQUEST[$input] ) && !empty( $_REQUEST[$input] ) ) {
                update_post_meta( $post_id, "_$input", sanitize_text_field($_REQUEST[$input]));
            }
        }
    }
}

// Pokemon->add_metabox( 'pokemon' )