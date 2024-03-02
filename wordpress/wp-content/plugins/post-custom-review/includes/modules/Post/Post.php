<?php

class POCR_Post extends ET_Builder_Module
{
    public $slug       = 'pocr_post_custom_review';
    public $vb_support = 'on';

    protected $module_credits = [
        'module_uri' => 'https://sebastianolaini.com/',
        'author'     => 'Sebastiano Laini',
        'author_uri' => 'https://sebastianolaini.com/',
    ];

    public function init()
    {
        $this->name = esc_html__('Post custom review', 'pocr-post-custom-review');
    }

    private function get_product_attributes()
    {
        $posts     = [];
        $raw_posts = get_posts(['numberposts' => -1, 'orderby' => 'date']);

        foreach ($raw_posts as $post) {
            $posts[$post->ID] = esc_html__($post->post_title, 'pocr-post-custom-review');
        }

        return $posts;
    }

    public function get_fields()
    {
        return [
            'post' => [
                'label'       => esc_html__('Post'),
                'description' => esc_html__('Choose the desired post.', 'pocr-post-custom-review'),
                'type'        => 'select',
                'toggle_slug' => 'main_content',
                'options'     => $this->get_product_attributes(),
            ],
            'card_title' => [
                'label'           => esc_html__('Card Title'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Input the card title.', 'pocr-post-custom-review'),
                'toggle_slug'     => 'main_content',
            ],
            'button_color' => [
                'label'            => esc_html__('Button Color', 'pocr-post-custom-review'),
                'description'      => esc_html__('Choose the Button Color.', 'pocr-post-custom-review'),
                'type'             => 'select',
                'toggle_slug'      => 'main_content',
                'option_category'  => 'basic_option',
                'default'          => '',
                'default_on_front' => '',
                'options'          => [
                    ''                           => esc_html__('Select Color', 'pocr-post-custom-review'),
                    'poca-product-button-blue'   => esc_html__('Blue', 'pocr-post-custom-review'),
                    'poca-product-button-purple' => esc_html__('Purple', 'pocr-post-custom-review'),
                ],
            ],
            'card_text' => [
                'label'           => esc_html__('Card text'),
                'type'            => 'tiny_mce',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Input the card text.', 'pocr-post-custom-review'),
                'toggle_slug'     => 'main_content',
            ]
        ];
    }

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
        $acfFields     = get_fields($this->props['post']);

        $yesList = [];
        $noList  = [];

        foreach ($acfFieldsList as $field) {
            if ($acfFields[$field] === true) {
                $yesList[] = '<li>' . $yesIcon . ' ' . $this->get_custom_fields_text($field) . '</li>';
            } else {
                $noList[] = '<li>' . $noIcon . ' ' . $this->get_custom_fields_text($field) . '</li>';
            }
        }

        return sprintf('<div class="pocr-hotel-review-list-wrapper">
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

    public function render($attrs, $content = null, $render_slug)
    {
        $query   = get_post($this->props['post']);
        $content = apply_filters('the_content', $query->post_content);

        return sprintf(
            '
			<div>
				<h3>%1$s</h3>

				<div class="pocr-hotel-review-wrapper">
                    <img src="%2$s" width="400" height="250" alt="%3$s" class="pocr-hotel-review-image size-medium" />

                    %4$s

                    <div class="pocr-hotel-review-bottom-wrapper">
                        %5$s

                        <div class="pocr-hotel-review-button-wrapper">
                            <a class="poca-product-button %6$s" href="%7$s">
                                Ver precio y disponibilidads
                            </a>

                            <a class="poca-product-button %6$s" href="%8$s">
                                Leer nuestra recensión
                            </a>
                        </div>
                    </div>
				</div>
			</div>
        ',
            $this->props['card_title'],
            get_the_post_thumbnail_url($this->props['post'], 'medium'),
            get_post_meta(get_post_thumbnail_id($this->props['post']), '_wp_attachment_image_alt', true),
            $this->props['card_text'],
            $this->get_custom_fields(),
            $this->props['button_color'],
            get_field('booking', $this->props['post']),
            get_permalink($this->props['post'])
        );
    }
}

new POCR_Post;
