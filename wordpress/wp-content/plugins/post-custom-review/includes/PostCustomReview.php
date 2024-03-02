<?php

class POCR_PostCustomReview extends DiviExtension
{
    /**
     * The gettext domain for the extension's translations.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $gettext_domain = 'pocr-post-custom-review';

    /**
     * The extension's WP Plugin name.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $name = 'post-custom-review';

    /**
     * The extension's version
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * POCR_PostCustomReview constructor.
     *
     * @param string $name
     * @param array  $args
     */
    public function __construct($name = 'post-custom-review', $args = [])
    {
        $this->plugin_dir     = plugin_dir_path(__FILE__);
        $this->plugin_dir_url = plugin_dir_url($this->plugin_dir);

        parent::__construct($name, $args);
    }
}

new POCR_PostCustomReview;
