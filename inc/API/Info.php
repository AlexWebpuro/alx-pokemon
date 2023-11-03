<?php

namespace Inc\API;

class Info {

    protected $pokemon_list = array();

    public function register() {
        // add_action( 'wp_head', array( $this, 'get_pokemon_list' ) );
        // add_action( 'wp_head', array( $this, 'get_initial_pokemons' ) );

        $this->get_pokemon_list();
        $this->get_initial_pokemons();
        // add_action('wp_footer', array( $this, '' ) );
    }

    public function get_pokemon_list() {
        $response = wp_remote_get( 'https://pokeapi.co/api/v2/pokemon?limit=5' );
        $pokemon_list = json_decode( wp_remote_retrieve_body( $response ) );

        $this->pokemon_list = $pokemon_list->results;
        return $this;
    }

    public function handle_types( array $types ) {
        $_types = array();
        foreach( $types as $type ) {
            array_push( $_types, $type->type->name );
        }

        return $_types;
    }

    public function get_old_game_indices( array $game_indices ) {
        return $game_indices[0]->game_index;
    }

    public function get_pokemon( string $url ) {

        $response = wp_remote_get( $url );
        $pokemon_body = json_decode( wp_remote_retrieve_body( $response ) );

        $img_url = $pokemon_body->sprites->other->{'official-artwork'}->front_default;
        $url_img = $this->get_image( $img_url, $pokemon_body->name );
        $url_img = $this->clean_url( $url_img );

        $img_id = $this->fetch_attachment_post_id_from_srcs( $url_img );

        $get_description = wp_remote_get( "https://pokeapi.co/api/v2/pokemon-species/$pokemon_body->name" );

        $desc_body = json_decode( wp_remote_retrieve_body( $get_description ) );

        $desciption = $desc_body->flavor_text_entries[0]->flavor_text;

        $desciption = str_replace(PHP_EOL, '', $desciption);
        // dd( $desciption );

        $pokemon = array(
            'name'              => ucfirst( $pokemon_body->name ),
            'description'       => stripslashes($desciption),
            'weight'            => $pokemon_body->weight,
            'type'              => $this->handle_types( $pokemon_body->types ),
            'pokedex_recent_id' => $pokemon_body->id,
            'pokedex_orlder_id' => $this->get_old_game_indices( $pokemon_body->game_indices ),
            'thumbnail_id'      => $img_id
        );

        return $pokemon;
    }

    public function clean_url( string $img_url ) {

        $pattern = "/src=['\"](http[s]?:\/\/[^'\"]+)['\"]/i";

        if (preg_match($pattern, $img_url, $matches)) {
            $url = $matches[1];
            return $url;
        }
    }

    public function get_initial_pokemons() {
        foreach( $this->pokemon_list as $pokemon ) {
            $res = $this->get_pokemon( $pokemon->url );
            $this->create_pokemon_post( $res );
        }
    }

    public function get_image( string $url, string $img_name ) {
        // https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png

        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Check if the URL is valid
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        // Download the image and save it to the media library
        $media_id = media_sideload_image( $url, 0, $img_name );
        
        // Check if the image was imported successfully
        if (is_wp_error($media_id)) {
            return false;
        }

        // Return the attachment ID of the imported image
        return $media_id;
    }

    public function create_pokemon_post( $pokemon ) {
        // Gather post data.
        $my_post = array(
            'post_title'    => $pokemon['name'],
            'post_content'  => $pokemon['description'],
            'post_status'   => 'publish',
            'post_author'   => 1,
            // 'post_category' => array( 8,39 ),
            'post_type'     => 'pokemon',
            'meta_input'    => array(
                '_pokemon_weight'                   => $pokemon['weight'],
                '_pokemon_type'                     => $pokemon['type'],
                '_pokemon_pokedex_recent_number'    => $pokemon['pokedex_recent_id'],
                '_pokemon_pokedex_orlder_number'    => $pokemon['pokedex_orlder_id'],
                '_thumbnail_id'                     => $pokemon['thumbnail_id'],
            ),
        );

        // Insert the post into the database.
        wp_insert_post( $my_post );
    }

    public function fetch_attachment_post_id_from_srcs( string $image_src ) {
        global $wpdb;

        $query = "SELECT ID FROM {$wpdb->posts} WHERE guid=%s";
        $id = $wpdb->prepare( $query, $image_src );
        $alx = $wpdb->get_results( $id );
        return $alx[0]->ID ;
    }
}

