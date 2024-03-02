<?php

if (!class_exists('ET_Builder_Element')) {
    return;
}

$module_files = glob(__DIR__ . '/modules/*/*.php');

// Load custom Divi Builder modules
foreach ((array) $module_files as $module_file) {
    if ($module_file && preg_match("/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file)) {
        require_once $module_file;
    }
}

function new_module_styles()
{ ?>
    <style>
        .et-db #et-boc .et-l .et-fb-modules-list .poca_post_custom_attributes::before {
            font-family: "etModules";
            content: "\e0ef";
        }
    </style>
<?php
}

add_action('admin_head', 'new_module_styles');
add_action('wp_head', 'new_module_styles');
