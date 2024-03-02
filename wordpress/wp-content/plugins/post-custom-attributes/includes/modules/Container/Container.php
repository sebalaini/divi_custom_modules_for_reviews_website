<?php

class poca_Container extends ET_Builder_Module
{
    public $slug       = 'poca_post_custom_attributes';
    public $vb_support = 'on';
    public $child_slug = 'poca_post_custom_attributes_item';

    protected $module_credits = [
        'module_uri' => 'https://sebastianolaini.com/',
        'author'     => 'Sebastiano Laini',
        'author_uri' => 'https://sebastianolaini.com/',
    ];

    public function init()
    {
        $this->name = esc_html__('Post Custom Attributes', 'poca-post-custom-attributes');
    }

    public function get_fields()
    {
        return [
            'toggle_header' => [
                'label'           => esc_html__('Show Header', 'poca-post-custom-attributes'),
                'description'     => esc_html__('Show a header', 'poca-post-custom-attributes'),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'main_content',
                'options'         => [
                    'off' => esc_html('No', 'poca-post-custom-attributes'),
                    'on'  => esc_html('Yes', 'poca-post-custom-attributes'),
                ],
                'default'         => 'off',
            ],
            'header' => [
                'label'           => esc_html__('Header', 'poca-post-custom-attributes'),
                'description'     => esc_html__('Header', 'poca-post-custom-attributes'),
                'type'            => 'text',
                'toggle_slug'     => 'main_content',
                'option_category' => 'basic_option',
                'show_if'         => [
                    'toggle_header' => 'on',
                ],
            ],
        ];
    }

    public function get_advanced_fields_config()
    {
        return [
            'text'           => false,
            'transform'      => false,
            'animation'      => false,
            'background'     => false,
            'borders'        => false,
            'box_shadow'     => false,
            'button'         => false,
            'filters'        => false,
            'fonts'          => false,
            'max_width'      => false,
            'margin_padding' => [
                'css' => [
                    'important' => 'all',
                ]
            ]
        ];
    }

    public function render($attrs, $content = null, $render_slug)
    {
        $header    = null;

        if ($this->props['toggle_header'] === 'on') {
            $header = '<h2 class="poca-custom-header">' . $this->props['header'] . '</h2>';
        }

        return sprintf(
            '%2$s
                <div class="poca-post-custom-attributes">
                    %1$s
                </div>
            ',
            $this->content,
            $header
        );
    }
}

new poca_Container;
