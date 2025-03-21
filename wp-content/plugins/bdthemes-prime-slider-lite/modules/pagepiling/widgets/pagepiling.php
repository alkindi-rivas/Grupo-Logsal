<?php
namespace PrimeSlider\Modules\Pagepiling\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Stroke;
use PrimeSlider\Utils;
use Elementor\Repeater;

use PrimeSlider\Traits\Global_Widget_Controls;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Pagepiling extends Widget_Base {

	use Global_Widget_Controls;

	public function get_name() {
		return 'prime-slider-pagepiling';
	}

	public function get_title() {
		return BDTPS . esc_html__( 'Pagepiling', 'bdthemes-prime-slider' );
	}

	public function get_icon() {
		return 'bdt-widget-icon ps-wi-pagepiling';
	}

	public function get_categories() {
		return [ 'prime-slider' ];
	}

	public function get_keywords() {
		return [ 'vertical', 'slider', 'fancy', 'slideshow', 'advanced', 'pagepiling' ];
	}

	public function get_style_depends() {
		return [ 'elementor-icons-fa-solid', 'elementor-icons-fa-brands', 'ps-pagepiling' ];
	}

	public function get_script_depends() {
		return [ 'jquery-pagepiling', 'ps-pagepiling' ];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/L7eWKJaZj5I';
	}

	public function has_widget_inner_wrapper(): bool {
        return ! \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
    }
	protected function is_dynamic_content(): bool {
		return false;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content_sliders',
			[
				'label' => esc_html__('Slide Items', 'bdthemes-prime-slider'),
			]
		);

		$repeater = new Repeater();

		/**
         * Repeater Sub Title Controls
         */
        $this->register_repeater_sub_title_controls($repeater);

		/**
         * Repeater Title Controls
         */
        $this->register_repeater_title_controls($repeater);

		/**
         * Repeater Title Link Controls
         */
        $this->register_repeater_title_link_controls($repeater);

		/**
         * Repeater Button Text & Link Controls
         */
        $this->register_repeater_button_text_link_controls($repeater);

		/**
         * Repeater Excerpt Controls
         */
        $this->register_repeater_excerpt_controls($repeater);

		$repeater->add_control(
			'slide_image',
			[
				'label'     => esc_html__('Slide Image', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'lightbox_link',
			[
				'label'         => __( 'Lightbox Source', 'bdthemes-prime-slider' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'default'       => [
					'url' => 'https://www.youtube.com/watch?v=YE7VzlLtp-4',
				],
				'placeholder'   => 'https://youtube.com/watch?v=xyzxyz',
				'label_block'   => true,
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'slides',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'sub_title' => esc_html__('Addons For Elementor', 'bdthemes-prime-slider'),
						'title' => esc_html__('Prime Slider', 'bdthemes-prime-slider'),
						'slide_image' => ['url' => BDTPS_CORE_ASSETS_URL . 'images/gallery/item-8.png']
					],
					[
						'sub_title' => esc_html__('Addons For Elementor', 'bdthemes-prime-slider'),
						'title' => esc_html__('Element Pack', 'bdthemes-prime-slider'),
						'slide_image' => ['url' => BDTPS_CORE_ASSETS_URL . 'images/gallery/item-4.png']
					],
					[
						'sub_title' => esc_html__('Discover your Talents', 'bdthemes-prime-slider'),
						'title' => esc_html__('On Prime Slider', 'bdthemes-prime-slider'),
						'slide_image' => ['url' => BDTPS_CORE_ASSETS_URL . 'images/gallery/item-6.png']
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_fancy_slider',
			[
				'label' => esc_html__( 'Additional Options', 'bdthemes-prime-slider' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		/**
		* Show Title Controls
		*/
		$this->register_show_title_controls();

		/**
		* Show Sub Title Controls
		*/
		$this->register_show_sub_title_controls();

		/**
		* Show Button Text Controls
		*/
		$this->register_show_button_text_controls();

		/**
		* Show Excerpt Controls
		*/
		$this->register_show_excerpt_controls();

		$this->add_control(
			'show_play_button',
			[
				'label'   => esc_html__('Show Play Button', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		/**
         * Show social links Controls
         */
        $this->register_show_social_link_controls();

		/**
		* Thumbnail Size Controls
		*/
		$this->register_thumbnail_size_controls();

		//Global background settings Controls
        $this->register_background_settings('.bdt-pagepiling-slider .pp-section');

		$this->add_responsive_control(
            'content_max_width',
            [
                'label' => __( 'Content Max Width', 'bdthemes-prime-slider' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1200,
                        'min' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content' => 'max-width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

		$this->add_responsive_control(
            'content_min_height',
            [
                'label' => __( 'Height', 'bdthemes-prime-slider' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1200,
                        'min' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-pagepiling-slider' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

		$this->add_responsive_control(
			'slide_text_align',
			[
				'label'   => __( 'Alignment', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bdthemes-prime-slider' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bdthemes-prime-slider' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bdthemes-prime-slider' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'bdthemes-prime-slider' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_social_link',
			[
				'label' 	=> __('Social Icon', 'bdthemes-prime-slider'),
				'condition' => [
					'show_social_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'social_main_title',
			[
				'label'   => __('Social Text', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Follow Us', 'bdthemes-prime-slider'),
			]
		);

		$repeater = new Repeater();


		$repeater->add_control(
			'social_link_title',
			[
				'label'   => __('Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
            'social_icon_link',
            [ 
                'label'   => __( 'Link', 'bdthemes-prime-slider' ),
                'type'    => Controls_Manager::URL,
            ]
        );

		$this->add_control(
			'social_link_list',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'social_icon_link'       => [ 
                            'url' => 'http://www.facebook.com/bdthemes/',
                        ],
						'social_link_title' => __('Fb.', 'bdthemes-prime-slider'),
					],
					[
						'social_icon_link'       => [ 
							'url' => 'http://www.twitter.com/bdthemes/',
						],
						'social_link_title' => __('Tw.', 'bdthemes-prime-slider'),
					],
					[
						'social_icon_link'       => [ 
							'url' => 'http://www.instagram.com/bdthemes/',
						],
						'social_link_title' => __('In.', 'bdthemes-prime-slider'),
					],
				],
				'title_field' => '{{{ social_link_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'bdthemes-prime-slider' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'scrollingSpeed',
			[
				'label'   => esc_html__( 'Scrolling Speed', 'bdthemes-prime-slider' ),
				'type' => Controls_Manager::SLIDER,
				'default' 		 => [
					'size' 			=> 700,
				],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'min' => 100,
                    ]
                ],
			]
		);

		$this->add_control(
            'navigation_position',
            [
                'label'   => __( 'Navigation Position', 'bdthemes-prime-slider' ) . BDTPS_CORE_PC,
                'type' 	  => Controls_Manager::SELECT,
				'default' => 'left',
                'options' => [
                    'left'       => __( 'Left', 'bdthemes-prime-slider' ),
                    'bottom'     => __( 'Bottom', 'bdthemes-prime-slider' ),
				],
				'classes'    => BDTPS_CORE_IS_PC
            ]
		);

		$this->add_control(
			'loopBottom',
			[
				'label'   => esc_html__( 'loop Bottom', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'loopTop',
			[
				'label'   => esc_html__( 'loop Top', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'bdthemes-prime-slider' ) . BDTPS_CORE_PC,
				'type'    => Controls_Manager::SWITCHER,
				'render_type' => 'template',
				'classes'    => BDTPS_CORE_IS_PC
			]
		);

		$this->add_control(
			'autoplay_duration',
			[
				'label'   => esc_html__( 'AutoPlay Duration', 'bdthemes-prime-slider' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' 	 => 1000,
				],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 5000,
                        'min' => 100,
                    ]
                ],
				'render_type' => 'template',
				'condition' => [
					'autoplay' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_style_sliders',
			[
				'label'     => esc_html__('Wrapper', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-ps-overlay:before',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Overlay', 'bdthemes-prime-slider'),
					],
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__('Content Margin', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sliders_title',
			[
				'label'     => esc_html__('Title', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-main-title .bdt-title-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'first_word_title_color',
            [
                'label'     => esc_html__('First Word Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-main-title .bdt-title-tag .frist-word' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'label' => __( 'Text Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-title-tag',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-main-title .bdt-title-tag',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-title-tag',
			]
		);

		$this->add_responsive_control(
			'prime_slider_title_spacing',
			[
				'label' => esc_html__('Title Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-title-tag' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sliders_sub_title',
			[
				'label'     => esc_html__('Sub Title', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_sub_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-sub-title .bdt-sub-title-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-sub-title .bdt-sub-title-tag',
			]
		);

		$this->add_responsive_control(
			'prime_slider_sub_title_spacing',
			[
				'label' => esc_html__('Sub Title Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-sub-title .bdt-sub-title-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label'     => esc_html__('Text', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => ['yes'],
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slider-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slider-excerpt',
			]
		);

		$this->add_responsive_control(
			'prime_slider_excerpt_spacing',
			[
				'label' 	=> esc_html__('Excerpt Spacing', 'bdthemes-prime-slider'),
				'type'  	=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 		=> [
						'min' 		=> 0,
						'max' 		=> 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slider-excerpt' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__('Button', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button_text' => ['yes'],
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');
		$this->start_controls_tab(
			'slider_button_style_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
            'readmore_text_color',
            [
                'label'     => __('Text Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn .bdt-button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'readmore_icon_color',
            [
                'label'     => __('Icon Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn:hover .bdt-button-circle .icon.arrow' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn .bdt-button-circle .icon.arrow:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'readmore_background',
                'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn .bdt-button-circle',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'readmore_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn .bdt-button-circle'
            ]
        );

        $this->add_responsive_control(
            'readmore_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-prime-slider'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn .bdt-button-circle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'readmore_icon_spacing',
            [
                'label'      => __('Icon Spacing', 'bdthemes-prime-slider'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn .bdt-button-text' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'readmore_typography',
                'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn .bdt-button-text',
            ]
        );

		$this->end_controls_tab();
		$this->start_controls_tab(
			'slider_button_style_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
            'readmore_hover_text_color',
            [
                'label'     => __('Text Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn:hover .bdt-button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'readmore_hover_icon_color',
            [
                'label'     => __('Icon Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn:hover .bdt-button-circle .icon.arrow' => 'background: {{VALUE}};',
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn:hover .bdt-button-circle .icon.arrow:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'readmore_hover_background',
                'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn:hover .bdt-button-circle',
            ]
        );

        $this->add_control(
            'readmore_hover_border_color',
            [
                'label'     => __('Border Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-pagepiling-slider .bdt-slide-btn:hover .bdt-button-circle' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'readmore_border_border!' => ''
                ]
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social_icon',
			[
				'label'     => esc_html__('Social Icon', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_social_icon' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_social_icon_style');

		$this->start_controls_tab(
			'tab_social_icon_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'social_text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon a, {{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon h3' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'social_divider_color',
			[
				'label'     => esc_html__('Divider Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon a:before, {{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon h3:before' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'social_icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon a'    => 'margin-right: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon h3'    => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'social_horizontal_spacing',
			[
				'label' => esc_html__('Horizontal Offset', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'social_text_typography',
				'selector' 	=> '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon a, {{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon h3',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_social_icon_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'social_icon_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-social-icon a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slide_play_button',
			[
				'label' 	=> esc_html__('Lightbox Play Button', 'bdthemes-prime-slider'),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_play_button' => ['yes'],
				],
			]
		);

		$this->start_controls_tabs('tabs_play_button_style');

		$this->start_controls_tab(
			'tab_play_button_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'slide_play_button_icon_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_play_button_background_color',
			[
				'label'     => esc_html__('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'slide_play_button_border',
				'selector'  => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a',
			]
		);

		$this->add_responsive_control(
			'slide_play_button_border_radius',
			[
				'label' 	 => __('Border Radius', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slide_play_button_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_play_button_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'slide_play_button_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'play_btn_hover_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_play_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider .bdt-prime-slider-content .bdt-slide-play-button a:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
                    'slide_play_button_border_border!' => ''
                ]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' 	=> esc_html__('Navigation', 'bdthemes-prime-slider'),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'slide_navigation_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider #pp-nav li a, {{WRAPPER}} .bdt-pagepiling-slider .pp-slidesNav li a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_navigation_active_color',
			[
				'label'     => esc_html__('Active Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider #pp-nav li a.active, {{WRAPPER}} .bdt-pagepiling-slider .pp-slidesNav li a.active' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_navigation_width',
			[
				'label' => esc_html__('Width', 'bdthemes-prime-slider') . BDTPS_CORE_PC,
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider #pp-nav li a, {{WRAPPER}} .bdt-pagepiling-slider .pp-slidesNav li a' => 'width: {{SIZE}}{{UNIT}};',
				],
				'classes'    => BDTPS_CORE_IS_PC
			]
		);

		$this->add_responsive_control(
			'slide_navigation_height',
			[
				'label' => esc_html__('Height', 'bdthemes-prime-slider') . BDTPS_CORE_PC,
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider #pp-nav li a, {{WRAPPER}} .bdt-pagepiling-slider .pp-slidesNav li a' => 'height: {{SIZE}}{{UNIT}};',
				],
				'classes'    => BDTPS_CORE_IS_PC
			]
		);

		$this->add_responsive_control(
			'slide_navigation_border_radius',
			[
				'label' 	 => __('Border Radius', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-pagepiling-slider #pp-nav li a, {{WRAPPER}} .bdt-pagepiling-slider .pp-slidesNav li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_navigation_left_spacing',
			[
				'label' => esc_html__('Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider #pp-nav.left' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation_position' => 'left'
				]
			]
		);

		$this->add_responsive_control(
			'slide_navigation_bottom_spacing',
			[
				'label' => esc_html__('Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagepiling-slider.bdt-ps-navigation-bottom #pp-nav.left' => 'bottom: -{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation_position' => 'bottom'
				]
			]
		);

		$this->end_controls_section();

	}

	public function render_social_link($class = []) {
		$settings  = $this->get_active_settings();

		if ('' == $settings['show_social_icon']) {
			return;
		}

		$this->add_render_attribute('social-icon', 'class', 'bdt-prime-slider-social-icon');
		$this->add_render_attribute('social-icon', 'class', $class);

		?>

			<div <?php $this->print_render_attribute_string('social-icon'); ?>>

				<h3><?php echo esc_html($settings['social_main_title']); ?></h3>

				<?php $this->render_social_link_repeater(); ?>

			</div>

		<?php
	}

	public function render_button($content) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('slider-button', 'class', 'bdt-slide-btn', true);
		if ($content['slide_button_text']) {
			$this->add_link_attributes('slider-button', $content['button_link'], true);
		}
		
		?>

		<?php if ( $content['slide_button_text'] && ('yes' == $settings['show_button_text']) && ! empty($content['button_link']['url']) ) : ?>

			<a <?php $this->print_render_attribute_string('slider-button'); ?>>

				<span class="bdt-button-circle" aria-hidden="true">
					<span class="icon arrow"></span>
				</span>
				<span class="bdt-button-text">
					<?php echo wp_kses($content['slide_button_text'], prime_slider_allow_tags('title')); ?>
				</span>

			</a>

			
		<?php endif;
	}

	protected function render_play_button($slide) {
		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();

		if ('' == $settings['show_play_button']) {
			return;
		}

		// remove global lightbox
		$this->add_render_attribute( 'lightbox-content', 'data-elementor-open-lightbox', 'no', true );
		$this->add_link_attributes( 'lightbox-content', $slide['lightbox_link'], true );
		
		$this->add_render_attribute( 'lightbox', 'class', 'bdt-slide-play-button', true );
		$this->add_render_attribute( 'lightbox', 'bdt-lightbox', 'video-autoplay: true;', true );
		
        ?>     
		<div <?php $this->print_render_attribute_string( 'lightbox' ); ?>>			

			<a <?php $this->print_render_attribute_string( 'lightbox-content' ); ?>>
				<svg aria-hidden="true" class="" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
			</a>

		</div>     
		<?php
	}

	public function render_item_content($slide_content) {
        $settings = $this->get_settings_for_display();

        if ($slide_content['title']) {
        	$this->add_link_attributes( 'title-link', $slide_content['title_link'], true );
        }
		

		?>
		<div class="bdt-prime-slider-content">
			<div data-bdt-slideshow-parallax="y: 150,0,-100; opacity: 1,1,0">
				<?php $this->render_play_button($slide_content); ?>
			</div>

			<?php if ($slide_content['sub_title'] && ('yes' == $settings['show_sub_title'])) : ?>
				<div class="bdt-sub-title">
					<<?php echo esc_attr(Utils::get_valid_html_tag($settings['sub_title_html_tag'])); ?> class="bdt-sub-title-tag" data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0">
						<?php echo wp_kses_post($slide_content['sub_title']); ?>
					</<?php echo esc_attr(Utils::get_valid_html_tag($settings['sub_title_html_tag'])); ?>>
				</div>
			<?php endif; ?>

			<?php if ($slide_content['title'] && ('yes' == $settings['show_title'])) : ?>
				<div class="bdt-main-title">
					<<?php echo esc_attr(Utils::get_valid_html_tag($settings['title_html_tag'])); ?> class="bdt-title-tag"  data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0">
						<?php if ('' !== $slide_content['title_link']['url']) : ?>
							<a <?php $this->print_render_attribute_string('title-link'); ?>>
							<?php endif; ?>
							<?php echo wp_kses_post(prime_slider_first_word($slide_content['title'])); ?>
							<?php if ('' !== $slide_content['title_link']['url']) : ?>
							</a>
						<?php endif; ?>
					</<?php echo esc_attr(Utils::get_valid_html_tag($settings['title_html_tag'])); ?>>
				</div>
			<?php endif; ?>

			<?php if ($slide_content['excerpt'] && ('yes' == $settings['show_excerpt'])) : ?>
				<div class="bdt-slider-excerpt" data-bdt-slideshow-parallax="y: 100,0,-80; opacity: 1,1,0">
					<?php echo wp_kses_post($slide_content['excerpt']); ?>
				</div>
			<?php endif; ?>

			<div data-bdt-slideshow-parallax="y: 150,0,-100; opacity: 1,1,0">
				<?php $this->render_button($slide_content); ?>
			</div>
		</div>

        <?php
    }

	public function render() {
		$settings         = $this->get_settings_for_display();
		
		$id = 'bdt-' . $this->get_id();

		$this->add_render_attribute('pagepiling-slider', 'class', 'bdt-pagepiling-slider');

		if ( 'bottom' == $settings['navigation_position'] ) {
			$this->add_render_attribute('pagepiling-slider', 'class', 'bdt-ps-navigation-bottom');
		}

		$this->add_render_attribute(
			[
				'pagepiling-slider' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"scrollingSpeed"     => $settings["scrollingSpeed"]["size"],
							"autoplay"       => ("yes" == $settings["autoplay"]) ? ["autoplay_duration" => $settings["autoplay_duration"]['size']] : false,
							"loopBottom"         => ("yes" == $settings["loopBottom"]) ? true : false,
							"loopTop"            => ("yes" == $settings["loopTop"]) ? true : false,
				        ]))
					]
				]
			]
		);

		?>
		<div <?php $this->print_render_attribute_string('pagepiling-slider'); ?> id="<?php echo esc_attr($id); ?>">

			<?php
			foreach ($settings['slides'] as $slide) : 

				$slide_image = Group_Control_Image_Size::get_attachment_image_src( $slide['slide_image']['id'], 'thumbnail_size', $settings);
                if ( ! $slide_image ) {
                    $slide_image = $slide['slide_image']['url'];
				}
				?>
					    
				<div class="section elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>" id="section-<?php echo esc_attr($slide['_id']); ?>" style="background-image: url('<?php echo esc_url( $slide_image); ?>');">

					<?php $this->render_item_content($slide); ?>

					<div class="bdt-ps-overlay"></div>
				</div>

			<?php endforeach;
			?>

			<?php $this->render_social_link(); ?>

		</div>
		<?php
	}
}
