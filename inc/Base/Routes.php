<?php

/*
 * @package Pokemon
 */

namespace Inc\Base;

class Routes extends BaseController {

    public function register() {
        add_action('init', array( $this, 'generate_rewrite_rule' ) );
    }

    public function generate_rewrite_rule() {
        // if( ! post_type_exists('pokemon') ) return;
        $args = array(
            'numberposts' 	=> -1,
            'post_type'		=> 'pokemon'
        );
    
        $posts = get_posts( $args );
        $max = count( $posts ) -1;
    
        $randon = rand( 0, $max );
    
        $pokemon = $posts[ $randon ]->post_name;
        
        add_rewrite_rule('random',"index.php?pokemon=$pokemon",'top');
        flush_rewrite_rules();
    }
}
