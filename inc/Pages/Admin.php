<?php

/*
 * @package Pokemon
 */

namespace Inc\Pages;

use Inc\Base\BaseController;

class Admin extends BaseController{
    
    public function register() {
       add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
    }

    public function add_admin_page() {
        add_menu_page('Pokemon plugin', 'Pokemon Settings', 'manage_options', 'pokemon_plugin', array( $this, 'admin_index'), 'dashicons-store', 5 );
    }

   public function admin_index() {
        require_once $this->plugin_path . 'templates/admin.php';
   }
}