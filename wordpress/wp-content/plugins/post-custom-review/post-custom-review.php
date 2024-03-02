<?php
/*
Plugin Name: Post Custom Review
Plugin URI:  https://sebastianolaini.com/
Description: post custom review
Version:     1.0.0
Author:      Sebastiano Laini
Author URI:  https://sebastianolaini.com/
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: pocr-post-custom-review
Domain Path: /languages
*/

if (!function_exists('pocr_initialize_extension')) :
    /**
     * Creates the extension's main class instance.
     *
     * @since 1.0.0
     */
    function pocr_initialize_extension()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/PostCustomReview.php';
    }
    add_action('divi_extensions_init', 'pocr_initialize_extension');
endif;
