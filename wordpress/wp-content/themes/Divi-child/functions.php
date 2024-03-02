<?php

/**
 * Load stylesheet & js
 */
function my_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/theme.js', ['jquery'], '', true);
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

/**
 * Remove jQuery migrate
 */
function remove_jquery_migrate($scripts)
{
    if (isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];

        if ($script->deps) {
            $script->deps = array_diff($script->deps, ['jquery-migrate']);
        }
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');
