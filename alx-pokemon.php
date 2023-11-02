<?php

/*
 * @package           Pokemon
 * @wordpress-plugin
 * Plugin Name:       Pokemon
 * Plugin URI:        https://alexmonroy.com/
 * Description:       A little test about wordpress development.
 * Version:           0.1
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Alex Monroy
 * Author URI:        https://alexmonroy.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://alexmonroy.com/
 * Text Domain:       alx-pokemonS
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die( "Hey you cant access this file!" );

if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

function activate_pokemon_plugin() {
    \Inc\Base\Activate::activate();
}

function deactivate_pokemon_plugin() {
    \Inc\Base\Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_pokemon_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_pokemon_plugin' );

if( class_exists( 'Inc\\Init' )) {
    Inc\Init::register_services();
}