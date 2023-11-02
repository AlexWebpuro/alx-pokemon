<?php

/*
 * @package Pokemon
 */

namespace Inc\Base;
use Inc\API\Info;

class Activate {

    public static function activate() {
        $first_pokemon = new Info();
        $first_pokemon->register();
        flush_rewrite_rules();
    }
}