<?php

/*
 * @package Pokemon
 */

namespace Inc;

final class Init {

    /**
     * Store all the classes inside an array.
     * @return array full list of classes.
     */
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\Routes::class,
            Base\Templates::class,
            Base\RESTApi::class,
            CPT\Pokemon::class,
        ];
    }

    /**
     * Loop through the classes, initalize them
     * and call the register() method if it exists.
     * @return void
     */
    public static function register_services() {
        foreach( self::get_services() as $class ) {
            $service = self::instantiate( $class );
            if( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     * @param class $class from the services array.
     * @return class intance new instance of the class.
     */
    private static function instantiate( $class ) {
        $service = new $class();
        return $service;
    }
}


// use Inc\Activate;
// use Inc\Deactivate;



// class Alx_Pokemon {

//    protected $plugin = '';

//    public function __construct()
//    {
//        add_action( 'init', array( $this, 'custom_post_type' ) );
//        $this->plugin = plugin_basename( __FILE__ );
//    }

//    public function register() {
//    }

//    public function activate() {
//        Activate::activate();
//    }

//    public function deactivate() {
//        Deactivate::deactivate();
//    }

//    public function uninstall() {

//    }



//    public function enqueue() {
//        if( ! is_singular( 'pokemon' ) ) return;
//        $css = plugins_url( '/assets/pokemon.css', __FILE__ );
//        wp_enqueue_style('alx-pokemon', $css, array(), '1.0', 'all' );
//    }
// }

// $pokemon = new Alx_Pokemon();
// $pokemon->register();

// register_activation_hook( __FILE__, array( $pokemon, 'activate' ) );
// register_deactivation_hook( __FILE__, array( $pokemon, 'deactivate' ) );
