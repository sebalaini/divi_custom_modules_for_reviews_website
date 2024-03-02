<?php

class poca_PostCustomAttributes extends DiviExtension
{
    /**
     * The gettext domain for the extension's translations.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $gettext_domain = 'poca-post-custom-attributes';

    /**
     * The extension's WP Plugin name.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $name = 'poca-post-custom-attributes';

    /**
     * The extension's version
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * poca_Attributes constructor.
     *
     * @param string $name
     * @param array  $args
     */
    public function __construct($name = 'poca-post-custom-attributes', $args = [])
    {
        $this->plugin_dir     = plugin_dir_path(__FILE__);
        $this->plugin_dir_url = plugin_dir_url($this->plugin_dir);

        parent::__construct($name, $args);
    }
}

new poca_PostCustomAttributes;
