<?php
/*
Plugin Name: Post Custom Attributes
Plugin URI:  https://sebastianolaini.com/
Description: post custom attributes
Version:     1.0.0
Author:      Sebastiano Laini
Author URI:  https://sebastianolaini.com/
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: poca-post-custom-attributes
Domain Path: /languages
*/

if (!function_exists('poca_initialize_extension')) :
    /**
     * Creates the extension's main class instance.
     *
     * @since 1.0.0
     */
    function poca_initialize_extension()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/PostCustomAttributes.php';
    }

    add_action('divi_extensions_init', 'poca_initialize_extension');
endif;
