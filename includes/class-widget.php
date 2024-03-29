<?php

namespace Elementor;


class Custom_Slider_Widget extends Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        wp_register_script('script-handle', KOC_CW_PATH . 'build/bundle.min.js?defer', ['elementor-frontend'], '25.0.0', true);
        wp_register_style('style-handle', KOC_CW_PATH . 'build/bundle.min.css');
    }
    private function gen_uid($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function get_script_depends()
    {
        return ['script-handle'];
    }

    public function get_style_depends()
    {
        return ['style-handle', 'ca-handle'];
    }

    public function get_name()
    {
        return 'customslider';
    }

    public function get_title()
    {
        return __('Custom Slider', 'plugin-name');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {

        //content tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'label_left',
            [
                'label' => __('Left Label', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Less Hard Sell', 'plugin-domain'),
                'placeholder' => __('Type your title here', 'plugin-domain'),
            ]
        );
        $this->add_control(
            'label_right',
            [
                'label' => __('Right Label', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('More Hard Sell', 'plugin-domain'),
                'placeholder' => __('Type your title here', 'plugin-domain'),
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->start_controls_tabs('tabs_medias');

        $repeater->add_control(
            'segment_color',
            [
                'label' => __('Segment Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',
            ]
        );
        $repeater->start_controls_tab(
            'tab_media_1',
            [
                'label' => __('Media 1', 'elementor'),
            ]
        );

        $repeater->add_control(
            'media1',
            [
                'name' => 'Choose Media File 1',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop1',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft1',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize1',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize1',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize1',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_control(
            'opacity1',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $repeater->add_control(
            'entrance_animation1',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );

        $repeater->add_control(
            'repeat_animation1',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay1',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_1',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );
        $repeater->end_controls_tab();


        $repeater->start_controls_tab(
            'tab_media_2',
            [
                'label' => __('Media 2', 'elementor'),
            ]
        );


        //media 2



        $repeater->add_control(
            'media2',
            [
                'name' => 'Choose Media File 2',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop2',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft2',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize2',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize2',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize2',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_control(
            'opacity2',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $repeater->add_control(
            'entrance_animation2',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );


        $repeater->add_control(
            'repeat_animation2',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay2',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_2',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );


        $repeater->end_controls_tab();







        $repeater->start_controls_tab(
            'tab_media_3',
            [
                'label' => __('Media 3', 'elementor'),
            ]
        );





        // media 3

        $repeater->add_control(
            'media3',
            [
                'name' => 'Choose Media File 3',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop3',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft3',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize3',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize3',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize3',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_control(
            'opacity3',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $repeater->add_control(
            'entrance_animation3',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );


        $repeater->add_control(
            'repeat_animation3',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay3',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_3',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );

        $repeater->end_controls_tab();

        //media 4


        $repeater->start_controls_tab(
            'tab_media_4',
            [
                'label' => __('Media 4', 'elementor'),
            ]
        );


        $repeater->add_control(
            'media4',
            [
                'name' => 'Choose Media File 4',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop4',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft4',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize4',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize4',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize4',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_control(
            'opacity4',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $repeater->add_control(
            'entrance_animation4',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );


        $repeater->add_control(
            'repeat_animation4',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay4',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_4',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );
        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();


        $repeater->add_control(
            'text_content',
            [
                'label' => __('Text', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __(' ', 'plugin-domain'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __('Slider Items', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text_content' => __('Item content. Click the edit button to change this text.', 'plugin-domain'),
                    ],
                ],
            ]
        );




        $this->end_controls_section();


        $this->start_controls_section(
            'display_options',
            [
                'label' => __('Display Options', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_speedometer',
            [
                'label' => __('Show Speedometer', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'No',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
                'render_type' => 'template',
            ]
        );
        $this->add_control(
            'show_step_marks',
            [
                'label' => __('Show Slider Step Marks', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'No',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
                'render_type' => 'template',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'speedometer_config',
            [
                'label' => __('Speedometer Settings', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'speedosize',
            [
                'label' => __('Speedometer Size', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 90,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 280,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-inner-container,{{WRAPPER}} .slider-inner-container > div ' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'template',
            ]
        );
        $this->add_responsive_control(
            'speedoinnersize',
            [
                'label' => __('Ring Size', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 60,
                    'unit' => '',
                ],
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 500,
                    ],

                ],
                'render_type' => 'template',
            ]
        );
        $this->add_responsive_control(
            'speedometerpos',
            [
                'label' => __('Speedometer position (Top)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 173,
                    'unit' => 'px',
                ],
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .speedometer' => 'top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'gap_size',
            [
                'label' => __('Gap SIze', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 4,
                    'unit' => '',
                ],
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'render_type' => 'template',
            ]
        );
        $this->add_control(
            'gap_color',
            [
                'label' => __('Gap Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'white',

            ]
        );

        $this->add_control(
            'unfilled_segment_color',
            [
                'label' => __('Unfilled Segment Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'section_config',
            [
                'label' => __('Section Settings', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'sectionminheight',
            [
                'label' => __('Section Min Height', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => 'vh',
                ],
                'size_units' => ['vh', '%', 'px', 'em', 'rem'],
                'range' => [
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-container' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'text_config',
            [
                'label' => __('Text Settings', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',

                'selectors' => [
                    '{{WRAPPER}} .text, {{WRAPPER}} .label-slider' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Text Typography', 'plugin-domain'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .text',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Text Alignment', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'elementor'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default' => 'center',
            ]
        );
        $this->add_responsive_control(
            'textposition',
            [
                'label' => __('Text Position (Top)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .text' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'textwidth',
            [
                'label' => __('Text Max Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 80,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .text' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'slider_section',
            [
                'label' => __('Slider Settings', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'slider_track_height',
            [
                'label' => __('Slider Height', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_track_width',
            [
                'label' => __('Slider Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-track-container ' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_track_color',
            [
                'label' => __('Slider Track Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',
                'selectors' => [
                    '{{WRAPPER}} .slider' => 'color: {{VALUE}}',
                ],
            ],



        );
        $this->add_responsive_control(
            'slider_thumb_size',
            [
                'label' => __('Slider Thumb Size', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-track-container .MuiSlider-thumb' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_thumb_color',
            [
                'label' => __('Slider Thumb Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',
                'selectors' => [
                    '{{WRAPPER}} .MuiSlider-thumb' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'slider_thumb_hover_color',
            [
                'label' => __('Slider Thumb Color Hover', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'blue',
                'selectors' => [
                    '{{WRAPPER}} .MuiSlider-thumb:hover' => 'color: {{VALUE}}',
                ],
            ]


        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __('Slider Labels Typography', 'plugin-domain'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .label-slider',
            ]
        );
        $this->add_responsive_control(
            'label_position',
            [
                'label' => __('Slider Labels Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .label-slider' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'needle_color',
            [
                'label' => __('Slider Needle Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pointer' => 'fill: {{VALUE}} !important',
                ],
                'default' => 'black'
            ]
        );
        $this->add_responsive_control(
            'needle_size',
            [
                'label' => __('Slider Needle Size', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.9,
                    'unit' => '',
                ],
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 1,
                    ],
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();


?>
        <div class="koc-slider-wrapper">
            <div class="hidden-variables" style="display:none !important">
                <div class="text-align"><?php echo $settings['text_align']; ?></div>
                <div class="unfilled-segment-color"><?php echo $settings['unfilled_segment_color']; ?></div>
                <div class="gap-size"><?php echo $settings["gap_size"]['size']; ?></div>
                <div class="needle-size"><?php echo $settings["needle_size"]['size']; ?></div>
                <p class="label-slider label-left"><?php echo $settings['label_left']; ?></p>
                <p class="label-slider label-right"><?php echo $settings['label_right']; ?></p>
                <div class="show_speedometer"><?php echo $settings['show_speedometer']; ?></div>
                <div class="show_step_marks"><?php echo $settings['show_step_marks']; ?></div>
                <div class="speedosize">
                    <div class="size"><?php echo $settings['speedosize']['size']; ?>
                    </div>
                    <div class="unit"><?php echo $settings['speedosize']['unit']; ?></div>
                </div>
                <div class="speedoinnersize"><?php echo $settings['speedoinnersize']['size']; ?></div>
            </div>
        </div>
        <div class="items" style="display:none !important" data-gap-color="<?php echo $settings['gap_color']; ?>">
            <?php
            if ($settings['list']) {
                foreach ($settings['list'] as $key => $item) {
            ?>
                    <div class=" item <?php echo 'elementor-repeater-item-' . $item['_id']; ?>" data-index="<?php echo esc_attr($key); ?>" data-color="<?php echo esc_attr($item['segment_color']); ?>">

                        <div class="text"><?php echo $item['text_content']; ?></div>
                        <div class="medias">
                            <?php for ($i = 1; $i <= 4; $i++) { ?>
                                <div class="<?php echo  $item["entrance_animation{$i}"]; ?> media media<?php echo $i; ?>" data-styles='{
                                 "opacity": "<?php echo $item['opacity'] ? $item['opacity'] : 1; ?>",
                                 
                                 "animationIterationCount": "<?php echo $item["animation_repeat_times_{$i}"] ? $item["animation_repeat_times_{$i}"] : 'infinite'; ?>",
                                       
                                "animationDuration": "<?php echo $item["animation_delay{$i}"] ?>s"
                                }
                                '>
                                    <?php echo esc_url($item["media{$i}"]['url']); ?>
                                </div>

                            <?php } ?>
                        </div>
                    </div>

            <?php
                }
            }

            ?>
        </div>
        <div class="slider-container" id="<?php echo $this->gen_uid(); ?>">

        </div>

        </div>
    <?php
    }

    protected function _content_template()
    {
    ?>
        <div class="koc-slider-wrapper">
            <div class="hidden-variables" style="display:none !important">
                <div class="text-align">{{{settings.text_align}}}</div>
                <div class="unfilled-segment-color">{{{settings.unfilled_segment_color}}}</div>
                <div class="gap-size">{{{settings.gap_size.size}}} </div>
                <div class="needle-size">{{{settings.needle_size.size}}} </div>
                <p class="label-slider label-left">{{{settings.label_left}}}</p>
                <p class="label-slider label-right">{{{settings.label_right}}} </p>
                <div class="hide-speedometer">{{{settings.hide_speedometer}}} </div>
                <div class="show_speedometer">{{{settings.show_speedometer}}} </div>
                <div class="show_step_marks">{{{settings.show_step_marks}}} </div>
                <div class="speedosize">
                    <div class="size">{{{settings.speedosize.size}}}
                    </div>
                    <div class="unit">{{{settings.speedosize.unit}}}</div>
                </div>
                <div class="speedoinnersize">{{{settings.speedoinnersize.size}}}</div>
            </div>
        </div>
        <div class="items" style="display:none !important" data-gap-color="{{{settings.gap_color}}}">
            <# _.each( settings.list, function( item,index ) { #>

                <div class="item elementor-repeater-item-{{{item._id}}}" data-index="{{{item.index}}}" data-color="{{{item.segment_color}}}">

                    <div class="text">
                        {{{item.text_content}}}
                    </div>
                    <div class="medias">

                        <div class="{{{item.entrance_animation1}}} media media1" data-styles='{
                            "opacity":  "{{{item.opacity1}}}",
                            <# if (item.animation_repeat_times_1 == 0) { #>
                            "animationIterationCount": "infinite",
                            <# } else { #>
                             "animationIterationCount": "{{{item.vs1}}}",    
                            <# } #>  
                            "animationDuration": "{{{item.animation_delay1}}}s"
                            }
                            '>
                            {{{item.media1.url}}}
                        </div>

                        <div class="{{{item.entrance_animation2}}} media media2" data-styles='{
                            "opacity":  "{{{item.opacity2}}}",
                            <# if (item.animation_repeat_times_2 == 0) { #>
                            "animationIterationCount": "infinite",
                            <# } else { #>
                             "animationIterationCount": "{{{item.animation_repeat_times_2}}}",    
                            <# } #>  
                            "animationDuration": "{{{item.animation_delay2}}}s"
                            }
                            '>
                            {{{item.media2.url}}}
                        </div>
                        <div class="{{{item.entrance_animation3}}} media media3" data-styles='{
                            "opacity":  "{{{item.opacity3}}}",
                            <# if (item.animation_repeat_times_3 == 0) { #>
                            "animationIterationCount": "infinite",
                            <# } else { #>
                             "animationIterationCount": "{{{item.animation_repeat_times_3}}}",    
                            <# } #> 
                            "animationDuration": "{{{item.animation_delay3}}}s"
                            }
                            '>
                            {{{item.media3.url}}}
                        </div>
                        <div class="{{{item.entrance_animation4}}} media media4" data-styles='{
                            "opacity":  "{{{item.opacity4}}}",
                            <# if (item.animation_repeat_times_4 == 0) { #>
                            "animationIterationCount": "infinite",
                            <# } else { #>
                             "animationIterationCount": "{{{item.animation_repeat_times_4}}}",    
                            <# } #>
                            "animationDuration": "{{{item.animation_delay4}}}s"
                            }
                            '>
                            {{{item.media4.url}}}
                        </div>
                    </div>
                </div>

                <# }); #>

        </div>
        <div class="slider-container" id="<?php echo $this->gen_uid(); ?>"> </div>

        </div>

<?php
    }
}
