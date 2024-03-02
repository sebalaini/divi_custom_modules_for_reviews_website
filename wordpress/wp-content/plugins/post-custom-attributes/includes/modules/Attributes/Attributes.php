<?php

class poca_Attributes extends ET_Builder_Module
{
    public $slug            = 'poca_post_custom_attributes_item';
    public $vb_support      = 'on';
    public $type            = 'child';
    public $child_title_var = 'attribute_text';

    public function init()
    {
        $this->name = esc_html__('Post Custom Attributes Item', 'poca-post-custom-attributes-item');
    }

    private function get_product_attributes()
    {
        $labels                     = [];
        $labels['']                 = esc_html__('Select Attribute', 'poca-post-custom-attributes-item');
        $labels['stars']            = esc_html__('Estrellas', 'poca-post-custom-attributes-item');
        $labels['booking']          = esc_html__('Booking', 'poca-post-custom-attributes-item');
        $labels['aconsejado_para']  = esc_html__('Aconsejado para', 'poca-post-custom-attributes-item');
        $labels['precio']           = esc_html__('Precio', 'poca-post-custom-attributes-item');
        $labels['list']             = esc_html__('List', 'poca-post-custom-attributes-item');

        return $labels;
    }

    public function get_fields()
    {
        return [
            'attribute' => [
                'label'       => esc_html__('Attribute'),
                'description' => esc_html__('Choose the desired attribute.', 'poca-post-custom-attributes-item'),
                'type'        => 'select',
                'toggle_slug' => 'main_content',
                'options'     => $this->get_product_attributes(),
            ],
            'attribute_text' => [
                'label'           => esc_html__('Attribute Text'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Input the attribute text.', 'poca-post-custom-attributes-item'),
                'toggle_slug'     => 'main_content',
            ],
            'attribute_type' => [
                'label'            => esc_html__('Attribute Type'),
                'description'      => esc_html__('Choose the attribute type.', 'poca-post-custom-attributes-item'),
                'type'             => 'select',
                'toggle_slug'      => 'main_content',
                'option_category'  => 'basic_option',
                'default'          => '',
                'default_on_front' => '',
                'options'          => [
                    ''        => esc_html__('Select Type', 'poca-post-custom-attributes-item'),
                    'button'  => esc_html__('Button', 'poca-post-custom-attributes-item'),
                    'list'    => esc_html__('List', 'poca-post-custom-attributes-item'),
                    'rating'  => esc_html__('Rating', 'poca-post-custom-attributes-item'),
                    'title'   => esc_html__('Title', 'poca-post-custom-attributes-item'),
                    'text'    => esc_html__('Text', 'poca-post-custom-attributes-item'),
                ],
            ],
            'rating_color' => [
                'label'            => esc_html__('Rating Color', 'poca-post-custom-attributes'),
                'description'      => esc_html__('Rating Color', 'poca-post-custom-attributes'),
                'type'             => 'select',
                'toggle_slug'      => 'main_content',
                'option_category'  => 'basic_option',
                'default'          => '',
                'default_on_front' => '',
                'show_if'          => [
                    'attribute_type' => 'rating',
                ],
                'options'          => [
                    ''                              => esc_html__('Select Color', 'poca-post-custom-attributes-item'),
                    'poca-hotel-rating-rate-blue'   => esc_html__('Blue', 'poca-post-custom-attributes-item'),
                    'poca-hotel-rating-rate-purple' => esc_html__('Purple', 'poca-post-custom-attributes-item'),
                ],
            ],
            'button_color' => [
                'label'            => esc_html__('Button Color', 'poca-post-custom-attributes'),
                'description'      => esc_html__('Button Color', 'poca-post-custom-attributes'),
                'type'             => 'select',
                'toggle_slug'      => 'main_content',
                'option_category'  => 'basic_option',
                'default'          => '',
                'default_on_front' => '',
                'show_if'          => [
                    'attribute_type' => 'button',
                ],
                'options'          => [
                    ''                           => esc_html__('Select Color', 'poca-post-custom-attributes-item'),
                    'poca-product-button-blue'   => esc_html__('Blue', 'poca-post-custom-attributes-item'),
                    'poca-product-button-purple' => esc_html__('Purple', 'poca-post-custom-attributes-item'),
                ],
            ]
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

    private function get_demo_text(): string
    {
        return match ($this->props['attribute_type']) {
            'text'    => 'Text',
            'button'  => 'Booking',
            'rating'  => 'Rating',
            'title'   => 'Hotel name',
            default   => 'did not match any demo text type',
        };
    }

    /**
     * Button
     */

    private function render_custom_button(string $heading, string $attribute): string
    {
        return sprintf(
            '<a class="poca-product-button %1$s" href="%2$s">%3$s</a>',
            $this->props['button_color'],
            $attribute,
            $heading
        );
    }

    /**
     * Rating
     */

    private function render_rating(string $heading, string $attribute): string
    {
        return sprintf(
            '<div class="poca-hotel-rating">
                <p class="poca-fonts poca-h3">%2$s</p>
                <div class="poca-hotel-rating-rate-wrapper">
                    <div class="poca-hotel-rating-rate %1$s">
                        %3$s
                        <span>/10</span>
                    </div>
                </div>
            </div>',
            $this->props['rating_color'],
            $heading,
            str_replace(',', '.', $attribute)
        );
    }

    /**
     * Star
     */

    private function render_stars_title(int $stars): string
    {
        $page_title = get_the_title(get_the_ID()) ?? $this->get_demo_text();

        return
            '<h1><div class="poca-hotel-rating-star">' .
            str_repeat('<svg xmlns="http://www.w3.org/2000/svg" height="25px" viewBox="0 0 576 512" fill="#fa5636"><path d="M259.3 17.8 194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>', (int)$stars) .
            '</div>' . $page_title . '</h1>';
    }

    /**
     * Text
     */

    private function render_text(string $heading, string $attribute): string
    {
        return sprintf(
            '<div class="poca-product-text">
                <p class="poca-fonts poca-h3">%1$s</p>
                <p class="poca-fonts poca-h4 poca-bold">%2$s</p>
            </div>',
            $heading,
            $attribute
        );
    }

    /**
     * List
     */

    private function get_custom_fields_text(string $name)
    {
        return match ($name) {
            'zona_de_juego'    => 'Parque infantil',
            'piscina_de_ninos' => 'Piscina de niños',
            'splash_pool'      => 'Piscina splash',
            'mini_club'        => 'Mini Club',
            'mini_golf'        => 'Mini Golf',
            'sala_de_juegos'   => 'Sala de juegos',
            'parque_de_bolas'  => 'Parque de bolas',
            'pista_de_deporte' => 'Instalaciones deportivas',
            'tobogan'          => 'Toboganes',
            'spa'              => 'SPA',
        };
    }

    private function get_custom_fields()
    {
        $noIcon  = '<svg viewBox="4 4 12 12" width="20px" fill="#DE668B" xmlns="http://www.w3.org/2000/svg"><path d="m14.348 14.849c-.469.469-1.229.469-1.697 0l-2.651-3.03-2.651 3.029c-.469.469-1.229.469-1.697 0-.469-.469-.469-1.229 0-1.697l2.758-3.15-2.759-3.152c-.469-.469-.469-1.228 0-1.697s1.228-.469 1.697 0l2.652 3.031 2.651-3.031c.469-.469 1.228-.469 1.697 0s.469 1.229 0 1.697l-2.758 3.152 2.758 3.15c.469.469.469 1.229 0 1.698z"/></svg>';
        $yesIcon = '<svg viewBox="2 2 16 16" width="20px" fill="#66DEB9" xmlns="http://www.w3.org/2000/svg"><path d="m8.294 16.998c-.435 0-.847-.203-1.111-.553l-3.573-4.721c-.465-.613-.344-1.486.27-1.951.615-.467 1.488-.344 1.953.27l2.351 3.104 5.911-9.492c.407-.652 1.267-.852 1.921-.445.653.406.854 1.266.446 1.92l-6.984 11.21c-.242.391-.661.635-1.12.656-.022.002-.042.002-.064.002z"/></svg>';

        $acfFieldsList = ['zona_de_juego', 'piscina_de_ninos', 'splash_pool', 'mini_club', 'mini_golf', 'sala_de_juegos', 'parque_de_bolas', 'pista_de_deporte', 'tobogan', 'spa'];
        $acfFields     = get_fields();

        $yesList = [];
        $noList  = [];

        foreach ($acfFieldsList as $field) {
            if ($acfFields[$field] === true) {
                $yesList[] = '<li>' . $yesIcon . ' ' . $this->get_custom_fields_text($field) . '</li>';
            } else {
                $noList[] = '<li>' . $noIcon . ' ' . $this->get_custom_fields_text($field) . '</li>';
            }
        }

        return sprintf('<div class="poca-hotel-review-list-wrapper">
            <div>
                <p class="poca-fonts poca-bold">Pros:</p>
                <ul>
                    %1$s
                </ul>
            </div>

            <div>
                <p class="poca-fonts poca-bold">Contras:</p>
                <ul>
                    %2$s
                </ul>
            </div>
        </div>', implode('', $yesList), implode('', $noList));
    }

    /**
     * Render
     */

    private function render_attribute_type(): string
    {
        $heading   = $this->props['attribute_text'] ?? $this->get_demo_text();
        $attribute = get_field($this->props['attribute']);

        return match ($this->props['attribute_type']) {
            'text'    => $this->render_text($heading, $attribute),
            'button'  => $this->render_custom_button($heading, $attribute),
            'list'    => $this->get_custom_fields(),
            'rating'  => $this->render_rating($heading, $attribute),
            'title'   => $this->render_stars_title($attribute),
            default   => 'did not match any attribute type',
        };
    }

    public function render($attrs, $content = null, $render_slug)
    {
        return sprintf(
            '<div class="poca-attribute">
                %1$s
            </div>
            ',
            $this->render_attribute_type()
        );
    }
}

new poca_Attributes;
