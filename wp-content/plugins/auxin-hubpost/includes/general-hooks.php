<?php
/**
 * General WordPress Hooks
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     averta
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2023 averta
 */



/**
 * Outputs theme options for hubpost
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     averta
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2023 averta
 */
function auxin_define_hubpost_theme_options( $fields_sections_list ){

    $options  = $fields_sections_list['fields'  ];
    $sections = $fields_sections_list['sections'];

    /* ---------------------------------------------------------------------------------------------------
        Hubpost Section
    --------------------------------------------------------------------------------------------------- */

    // Hubpost section ==================================================================

    $sections[] = array(
        'id'          => 'hubpost-section',
        'parent'      => '', // section parent's id
        'title'       => __( 'Hubpost', 'auxin-hubpost'),
        'description' => __( 'Hubpost Setting', 'auxin-hubpost'),
        'icon'        => 'axicon-doc'
    );

    // Sub section - Hubpost Single Page -------------------------------

    $sections[] = array(
        'id'           => 'hubpost-section-single',
        'parent'       => 'hubpost-section', // section parent's id
        'title'        => __( 'Single Hubpost', 'auxin-hubpost'),
        'description'  => __( 'Preview a Single Hubpost Page', 'auxin-hubpost'),
        'preview_link' => auxin_get_last_post_permalink( array( 'post_type' => 'hubpost' ) )
    );


    $options[] = array(
        'title'       => __('Single Hubpost Template', 'auxin-hubpost'),
        'description' => __('Specifies single hubpost template.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_side_pos',
        'section'     => 'hubpost-section-single',
        'dependency'  => array(),
        'choices'     => array(
            'right'     => array(
                'label' => __('Info on Right', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-classic.svg'
            ),
            'left'   => array(
                'label' => __('Info on Left', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-classic-left-algin.svg'
            ),
            'top'   => array(
                'label' => __('Info on Top', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-info-on-top-direction-reverse.svg'
            ),
            'top-reverse'   => array(
                'label' => __('Info on Top - Direction reverse', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-info-on-top.svg'
            ),
            'top-down'   => array(
                'label' => __('Info on Top - Metadata Below', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-info-on-top-metadata-on-blow.svg'
            ),
            'bottom'   => array(
                'label' => __('Info on Bottom', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-wide.svg'
            ),
            'bottom-reverse'   => array(
                'label' => __('Info on Bottom - Direction reverse', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-wide2.svg'
            ),
            'bottom-down'   => array(
                'label' => __('Info on Bottom - Metadata Below', 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/hubpost-single-info-on-bottom-metadata-blow.svg'
            )
        ),
        'default'     => 'right',
        'type'        => 'radio-image',
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.single-hubpost .aux-single .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
            }
        )
    );

    $options[] = array(
        'title'       => __( 'Custom Max Width', 'auxin-hubpost' ),
        'description' => __( 'Specifies the maximum width of website.', 'auxin-hubpost' ),
        'id'          => 'hubpost_max_width_layout',
        'section'     => 'hubpost-section-single',
        'type'        => 'select',
        'transport'   => 'postMessage',
        'dependency'  => array(),
        'choices'     => array(
            ''      => __( 'Default Site Max Width', 'auxin-hubpost' ),
            'nd'    => __( '1000 Pixels', 'auxin-hubpost' ),
            'hd'    => __( '1200 Pixels', 'auxin-hubpost' ),
            'xhd'   => __( '1400 Pixels', 'auxin-hubpost' ),
            's-fhd' => __( '1600 Pixels', 'auxin-hubpost' ),
            'fhd'   => __( '1900 Pixels', 'auxin-hubpost' )
        ),
        'post_js'   => '$( "body.single-hubpost" ).removeClass( "aux-nd aux-hd aux-xhd aux-s-fhd aux-fhd" ).addClass( "aux-" + to ); $(window).trigger("resize");',
        'default'   => ''
    );

    $options[] = array(
        'title'       => __('Overview Alignment', 'auxin-hubpost'),
        'description' => __('Specifies alignment for the project overview and corresponding information.', 'auxin-hubpost'),
        'id'          => 'hubposts_overview_info_alignment',
        'section'     => 'hubpost-section-single',
        'dependency'  => array(),
        'type'        => 'radio-image',
        'default'     => 'default',
        'choices'     => array(
            'left' => array(
                'label'     => __('Left', 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-text-align-left'
            ),
            'center' => array(
                'label'     => __('Center', 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-text-align-center'
            )
        ),
        'post_js'     => '$(".single-hubpost main.aux-single .aux-primary .type-hubpost").alterClass( "aux-text-align-*", "aux-text-align-" + to );',
    );

    $options[] = array(
        'title'       => __( 'Image Size', 'auxin-hubpost' ),
        'description' => __( 'Select size of featured image', 'auxin-hubpost' ),
        'id'          => 'hubpost_single_image_size',
        'section'     => 'hubpost-section-single',
        'transport'   => 'refresh',
        'type'        => 'select',
        'choices'     => array(
            ''              => __( 'Default', 'auxin-hubpost' ),
            'medium'        => __( 'Medium', 'auxin-hubpost' ),
            'medium_large'  => __( 'Medium Large', 'auxin-hubpost'),
            'large'         => __( 'Large', 'auxin-hubpost'),
            'full'          => __( 'Original', 'auxin-hubpost'),
        ),
        'default'     => '',
    );

    $options[] =    array(
        'title'       => __('Display Hubpost Meta Info', 'auxin-hubpost'),
        'description' => __('Enable this option to display extra inormation on hubpost single page.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_display_side_info_meta',
        'section'     => 'hubpost-section-single',
        'dependency'  => '',
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.single-hubpost .aux-single .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
            }
        ),
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Display Single Hubpost Categories', 'auxin-hubpost'),
        'description' => __( 'Enable it to display category section in single hubpost.'),
        'id'          => 'hubpost_single_display_category',
        'section'     => 'hubpost-section-single',
        'dependency'  => '',
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.single-hubpost .aux-single .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
            }
        ),
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Display Single Hubpost Tags', 'auxin-hubpost'),
        'description' => __( 'Enable it to display Tag section in single hubpost.'),
        'id'          => 'hubpost_single_display_tag',
        'section'     => 'hubpost-section-single',
        'dependency'  => '',
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.single-hubpost .aux-single .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
            }
        ),
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Sticky Side Area', 'auxin-hubpost'),
        'description' => __( 'Enable it to stick the side area on page while scrolling..'),
        'id'          => 'hubpost_single_sticky_sidebar',
        'section'     => 'hubpost-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'hubpost_single_side_pos',
                 'value'   => array('right', 'left'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.single-hubpost .aux-single .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
            }
        ),
        'default'     => '0',
        'type'        => 'switch'
    );



    $options[] = array(
        'title'       => __( 'Display Next & Previous hubposts', 'auxin-hubpost' ),
        'description' => __( 'Enable it to display links to next and previous hubposts on single hubpost page.' ),
        'id'          => 'show_hubpost_single_next_prev_nav',
        'section'     => 'hubpost-section-single',
        'dependency'  => '',
        'transport'   => 'refresh',
        // 'post_js'     => '$(".single .aux-next-prev-posts").toggle( to );',
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Display share/action bar', 'auxin-hubpost'),
        'description' => __( 'Enable it to display the section for share and like button.'),
        'id'          => 'show_hubpost_single_share_like_section',
        'section'     => 'hubpost-section-single',
        'dependency'  => '',
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.single-hubpost .aux-single .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
            }
        ),
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Display share button', 'auxin-hubpost'),
        'description' => __( 'Enable it to display the share button.'),
        'id'          => 'show_hubpost_single_share',
        'section'     => 'hubpost-section-single',
        'dependency'  => '',
        'transport'   => 'postMessage',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_share_like_section',
                 'value'   => '1'
            )
        ),
        'partial'     => array(
            'selector'              => '.single-hubpost .aux-single .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
            }
        ),
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'       => __( 'Share Type', 'auxin-hubpost' ),
        'description' => __( 'Enable it to display text instead of icon.', 'auxin-hubpost' ),
        'id'          => 'hubpost_single_share_button_type',
        'section'     => 'hubpost-section-single',
        'transport'   => 'postMessage',
        'type'        => 'select',
        'choices'     => array(
            'icon'    => __( 'Icon', 'auxin-hubpost' ),
            'text'    => __( 'Text', 'auxin-hubpost' )
        ),
        'dependency'  => array(
            array(
                'id'      => 'show_hubpost_single_share_like_section',
                'value'   => array('1'),
                'operator'=> ''
            ),
            array(
                'id'      => 'show_hubpost_single_share',
                'value'   => array('1'),
                'operator'=> ''
            )
        ),
        'default'     => 'icon',
    );

    $options[] = array(
        'title'       => __( 'Share Button Icon', 'auxin-hubpost' ),
        'id'          => 'hubpost_single_share_button_icon',
        'section'     => 'hubpost-section-single',
        'transport'   => 'refresh',
        'type'        => 'icon',
        'default'     => 'auxicon-share',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_share_like_section',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'show_hubpost_single_share',
                'value'   => array('1'),
                'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_single_share_button_type',
                'value'   => array('icon'),
                'operator'=> ''
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Icon Color', 'auxin-hubpost' ),
        'description'   => __( 'Share icon color','auxin-hubpost' ),
        'id'            => 'hubpost_single_share_button_icon_color',
        'section'       => 'hubpost-section-single',
        'transport'     => 'postMessage',
        'type'          => 'color',
        'selectors'     => '.single-hubpost .aux-single-hubpost-share span::before',
        'placeholder'   => 'color:{{VALUE}};',
        'default'       => '',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_share_like_section',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'show_hubpost_single_share',
                'value'   => array('1'),
                'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_single_share_button_type',
                'value'   => array('icon'),
                'operator'=> ''
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Icon Hover Color', 'auxin-hubpost' ),
        'description'   => __( 'Share icon hover color','auxin-hubpost' ),
        'id'            => 'hubpost_single_share_button_icon_hover_color',
        'section'       => 'hubpost-section-single',
        'transport'     => 'postMessage',
        'type'          => 'color',
        'selectors'     => '.single-hubpost .aux-single-hubpost-share span:hover::before',
        'placeholder'   => 'color:{{VALUE}};',
        'default'       => '',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_share_like_section',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'show_hubpost_single_share',
                'value'   => array('1'),
                'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_single_share_button_type',
                'value'   => array('icon'),
                'operator'=> ''
            )
        )
    );

    $options[] = array(
        'title'       => __( 'Share Button Icon Size', 'auxin-hubpost' ),
        'id'          => 'hubpost_single_share_button_icon_size',
        'section'     => 'hubpost-section-single',
        'transport'   => 'postMessage',
        'type'        => 'text',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_share_like_section',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'show_hubpost_single_share',
                'value'   => array('1'),
                'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_single_share_button_type',
                'value'   => array('icon'),
                'operator'=> ''
            )
        ),
        'style_callback' => function( $value = null ){
            if( ! $value ){
                $value = esc_attr( auxin_get_option( 'hubpost_single_share_button_icon_size' ) );
            }
            if( ! is_numeric( $value ) ){
                $value = 10;
            }
            return $value ? ".single-hubpost .aux-single-hubpost-share span::before { font-size:{$value}px; }" : '';
        }
    );

    $options[] = array(
        'title'          => __( 'Share Button Margin', 'auxin-hubpost' ),
        'id'             => 'hubpost_single_share_button_margin',
        'section'        => 'hubpost-section-single',
        'type'           => 'responsive_dimensions',
        'selectors'      => '.single-hubpost .aux-single-hubpost-share',
        'transport'      => 'postMessage',
        'placeholder'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_share_like_section',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'show_hubpost_single_share',
                'value'   => array('1'),
                'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_single_share_button_type',
                'value'   => array('icon'),
                'operator'=> ''
            )
        ),
    );

    if ( class_exists( 'wp_ulike' ) ) {
        $options[] =    array(
            'title'       => __('Display like button', 'auxin-hubpost'),
            'description' => __( 'Enable it to display the like button. Please note that you should have "ulike" plugin installed for this feature.'),
            'id'          => 'show_hubpost_single_like',
            'section'     => 'hubpost-section-single',
            'dependency'  => '',
            'transport'   => 'postMessage',
            'dependency'  => array(
                array(
                    'id'      => 'show_hubpost_single_share_like_section',
                    'value'   => '1'
                )
            ),
            'partial'     => array(
                'selector'              => '.single-hubpost .aux-single .content',
                'container_inclusive'   => false,
                'render_callback'       => function(){
                    auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');
                }
            ),
            'default'     => '1',
            'type'        => 'switch'
        );

        $options[] = array(
            'title'       => __( 'Like Type', 'auxin-hubpost' ),
            'description' => __( 'Enable it to display text instead of icon.', 'auxin-hubpost' ),
            'id'          => 'hubpost_single_like_button_type',
            'section'     => 'hubpost-section-single',
            'transport'   => 'postMessage',
            'type'        => 'select',
            'choices'     => array(
                'icon'  => __( 'Icon', 'auxin-hubpost' ),
                'text'  => __( 'Text', 'auxin-hubpost' )
            ),
            'dependency'  => array(
                array(
                    'id'      => 'show_hubpost_single_share_like_section',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                )
            ),
            'default'     => 'icon',
        );

        $options[] =    array(
            'title'       => __('Show "likes" label ', 'auxin-hubpost'),
            'description' => __( 'Enable to show "Likes" label in front of like icon after clicking on it.', 'auxin-hubpost' ),
            'id'          => 'show_hubpost_single_like_label',
            'section'     => 'hubpost-section-single',
            'dependency'  => '',
            'transport'   => 'postMessage',
            'dependency'  => array(
                array(
                    'id'      => 'show_hubpost_single_share_like_section',
                    'value'   => '1'
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'hubpost_single_like_button_type',
                    'value'   => array('icon'),
                    'operator'=> ''
                )
            ),
            'default'     => '1',
            'type'        => 'switch'
        );

        $options[] = array(
            'title'       => __( 'Like Icon', 'auxin-hubpost' ),
            'id'          => 'hubpost_single_like_icon',
            'section'     => 'hubpost-section-single',
            'transport'   => 'refresh',
            'type'        => 'icon',
            'default'     => 'auxicon-heart-2',
            'dependency'  => array(
                array(
                     'id'      => 'show_hubpost_single_share_like_section',
                     'value'   => array('1'),
                     'operator'=> ''
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'hubpost_single_like_button_type',
                    'value'   => array('icon'),
                    'operator'=> ''
                )
            )
        );

        $options[] = array(
            'title'         => __( 'Icon Liked Color', 'auxin-hubpost' ),
            'description'   => __( 'Like icon color','auxin-hubpost' ),
            'id'            => 'hubpost_single_like_icon_color',
            'section'       => 'hubpost-section-single',
            'transport'     => 'postMessage',
            'type'          => 'color',
            'selectors'     => '.single-hubpost .wp_ulike_is_liked button::before, .single-hubpost .wp_ulike_is_unliked.wp_ulike_is_liked button::before, .single-hubpost .wp_ulike_is_not_liked.wp_ulike_is_liked button::before',
            'placeholder'   => 'color:{{VALUE}};',
            'default'       => '',
            'dependency'  => array(
                array(
                     'id'      => 'show_hubpost_single_share_like_section',
                     'value'   => array('1'),
                     'operator'=> ''
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'hubpost_single_like_button_type',
                    'value'   => array('icon'),
                    'operator'=> ''
                )
            )
        );

        $options[] = array(
            'title'         => __( 'Icon Not Liked Color', 'auxin-hubpost' ),
            'description'   => __( 'Like icon color','auxin-hubpost' ),
            'id'            => 'hubpost_single_not_like_icon_color',
            'section'       => 'hubpost-section-single',
            'transport'     => 'postMessage',
            'type'          => 'color',
            'selectors'     => '.single-hubpost .wp_ulike_is_unliked button::before, .single-hubpost .wp_ulike_is_not_liked button:before ',
            'placeholder'   => 'color:{{VALUE}};',
            'default'       => '',
            'dependency'  => array(
                array(
                     'id'      => 'show_hubpost_single_share_like_section',
                     'value'   => array('1'),
                     'operator'=> ''
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'hubpost_single_like_button_type',
                    'value'   => array('icon'),
                    'operator'=> ''
                )
            )
        );

        $options[] = array(
            'title'         => __( 'Icon Hover Color', 'auxin-hubpost' ),
            'description'   => __( 'Like icon hover color','auxin-hubpost' ),
            'id'            => 'hubpost_single_like_icon_hover_color',
            'section'       => 'hubpost-section-single',
            'transport'     => 'postMessage',
            'type'          => 'color',
            'selectors'     => '.single-hubpost .wp_ulike_general_class button:hover::before',
            'placeholder'   => 'color:{{VALUE}};',
            'default'       => '',
            'dependency'  => array(
                array(
                     'id'      => 'show_hubpost_single_share_like_section',
                     'value'   => array('1'),
                     'operator'=> ''
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'hubpost_single_like_button_type',
                    'value'   => array('icon'),
                    'operator'=> ''
                )
            )
        );

        $options[] = array(
            'title'       => __( 'Like Button Icon Size', 'auxin-hubpost' ),
            'id'          => 'hubpost_single_like_icon_size',
            'section'     => 'hubpost-section-single',
            'transport'   => 'postMessage',
            'type'        => 'text',
            'dependency'  => array(
                array(
                     'id'      => 'show_hubpost_single_share_like_section',
                     'value'   => array('1'),
                     'operator'=> ''
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'hubpost_single_like_button_type',
                    'value'   => array('icon'),
                    'operator'=> ''
                )
            ),
            'style_callback' => function( $value = null ){
                if( ! $value ){
                    $value = esc_attr( auxin_get_option( 'hubpost_single_like_icon_size' ) );
                }
                if( ! is_numeric( $value ) ){
                    $value = 10;
                }
                return $value ? ".single-hubpost .wp_ulike_general_class button::before { font-size:{$value}px; }" : '';
            }
        );

        $options[] = array(
            'title'          => __( 'Like Button Margin', 'auxin-hubpost' ),
            'id'             => 'hubpost_single_like_margin',
            'section'        => 'hubpost-section-single',
            'type'           => 'responsive_dimensions',
            'selectors'      => '.single-hubpost .wp_ulike_general_class button',
            'transport'      => 'postMessage',
            'placeholder'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            'dependency'  => array(
                array(
                     'id'      => 'show_hubpost_single_share_like_section',
                     'value'   => array('1'),
                     'operator'=> ''
                ),
                array(
                    'id'      => 'show_hubpost_single_like',
                    'value'   => array('1'),
                    'operator'=> ''
                ),
                array(
                    'id'      => 'hubpost_single_like_button_type',
                    'value'   => array('icon'),
                    'operator'=> ''
                )
            ),
        );
    }

    $options[] =    array(
        'title'       => __('Skin for Next & Previous Links', 'auxin-hubpost'),
        'description' => __('Specifies the skin for next and previous navigation block.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_next_prev_nav_skin',
        'section'     => 'hubpost-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_next_prev_nav',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'choices'     => array(
            'minimal'       => array(
                'label'     => __('Minimal (default)', 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/post-navigation-1.svg'
            ),
            'classic-title'    => array(
                'label'             => __('Classic Project Navigation', 'auxin-hubpost'),
                'image'             => AUXIN_URL . 'images/visual-select/post-navigation-6.svg'
            ),
            'classic'    => array(
                'label'             => __('Classic Project Navigation Without Title', 'auxin-hubpost'),
                'image'             => AUXIN_URL . 'images/visual-select/post-navigation-6.svg'
            ),
            'thumb-arrow'   => array(
                'label'     => __('Thumbnail with Arrow', 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/post-navigation-2.svg'
            ),
            'thumb-no-arrow'        => array(
                'label'             => __('Thumbnail without Arrow', 'auxin-hubpost'),
                'image'             => AUXIN_URL . 'images/visual-select/post-navigation-3.svg'
            ),
            'boxed-image'           => array(
                'label'             => __('Navigation with Light Background', 'auxin-hubpost'),
                'image'             => AUXIN_URL . 'images/visual-select/post-navigation-4.svg'
            ),
            'boxed-image-dark'      => array(
                'label'             => __('Navigation with Dark Background', 'auxin-hubpost'),
                'image'             => AUXIN_URL . 'images/visual-select/post-navigation-5.svg'
            ),
            'thumb-arrow-sticky'    => array(
                'label'             => __('Sticky Thumbnail with Arrow', 'auxin-hubpost'),
                'image'             => AUXIN_URL . 'images/visual-select/post-navigation-6.svg'
            ),
            'modern'    => array(
                'label'             => __('Modern', 'auxin-hubpost'),
                'image'             => AUXIN_URL . 'images/visual-select/post-navigation-2.svg'
            )
        ),
        'type'       => 'radio-image',
        'default'    => 'minimal'
    );

    $options[] =    array(
        'title'       => __('Next Hubpost Label', 'auxin-hubpost'),
        'description' => __('Specifies the word after next and previous navigation.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_next_nav_label',
        'section'     => 'hubpost-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_next_prev_nav',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
        ),
        'transport'  => 'postMessage',
        'post_js'     => '$(".single-hubpost .aux-next-prev-posts .np-next-section .np-nav-text").text( to );',
        'type'       => 'text',
        'default'    => 'Next Hubpost'
    );

    $options[] =    array(
        'title'       => __('Previous Hubpost Label', 'auxin-hubpost'),
        'description' => __('Specifies the word after next and previous navigation.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_prev_nav_label',
        'section'     => 'hubpost-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_next_prev_nav',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
        ),
        'transport'  => 'postMessage',
        'post_js'     => '$(".single-hubpost .aux-next-prev-posts .np-prev-section .np-nav-text").text( to );',
        'type'       => 'text',
        'default'    => 'Previous Hubpost'
    );

    $options[] =    array(
        'title'       => __('Next & Previous Button Link', 'auxin-hubpost'),
        'description' => __('Specifies the link of button in next and previous navigation. leave it blank to use default hubpost archive link', 'auxin-hubpost'),
        'id'          => 'hubpost_single_next_prev_nav_btn_link',
        'section'     => 'hubpost-section-single',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_single_next_prev_nav',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_single_next_prev_nav_skin',
                'value'   => array('modern', 'classic', 'classic-title'),
                'operator'=> ''
           )
        ),
        'transport'  => 'refresh',
        'type'       => 'text',
        'default'    => '',
    );


    // Sub section - Hubpost Single Page -------------------------------

    $sections[] = array(
        'id'           => 'hubpost-section-single-titlebar',
        'parent'       => 'hubpost-section', // section parent's id
        'title'        => __( 'Hubpost Title', 'auxin-hubpost' ),
        'description'  => __( 'Preview a Single Hubpost Page', 'auxin-hubpost'),
        'preview_link' => auxin_get_last_post_permalink( array( 'post_type' => 'hubpost' ) )
    );

    $options[] = array(
        'title'         => __( 'Display Title Bar Section', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to show the title section.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_show',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0'
    );

    $options[] = array(
        'title'         => __( 'Layout presets', 'auxin-hubpost' ),
        'description'   => '',
        'id'            => 'hubpost_title_bar_preset',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'radio-image',
        'default'       => 'normal_title_1',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices'       => array(
            'normal_title_1' => array(
                'label'   => __( 'Default', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-4.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'auto',
                    'hubpost_title_bar_heading_bordered'        => 0,
                    'hubpost_title_bar_heading_boxed'           => 0,
                    'hubpost_title_bar_meta_enabled'            => 0,
                    'hubpost_title_bar_bread_enabled'           => 1,
                    'hubpost_title_bar_bread_bordered'          => 0,
                    'hubpost_title_bar_bread_sep_style'         => 'arrow',
                    'hubpost_title_bar_text_align'              => 'left',
                    'hubpost_title_bar_vertical_align'          => 'top',
                    'hubpost_title_bar_scroll_arrow'            => 'none',
                    'hubpost_title_bar_color_style'             => 'dark',
                    'hubpost_title_bar_overlay_color'           => ''
                )
            ),
            'normal_bg_light_1' => array(
                'label'   => __( 'Title bar with light overlay which is aligned center', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-1.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'auto',
                    'hubpost_title_bar_heading_bordered'        => 0,
                    'hubpost_title_bar_heading_boxed'           => 0,
                    'hubpost_title_bar_bread_enabled'           => 1,
                    'hubpost_title_bar_bread_bordered'          => 0,
                    'hubpost_title_bar_bread_sep_style'         => 'arrow',
                    'hubpost_title_bar_text_align'              => 'center',
                    'hubpost_title_bar_vertical_align'          => 'top',
                    'hubpost_title_bar_scroll_arrow'            => 'none',
                    'hubpost_title_bar_color_style'             => 'dark',
                    'hubpost_title_bar_overlay_color'           => ''
                )
            ),
            'full_bg_light_1' => array(
                'label'   => __( 'Fullscreen title bar with light overlay on background', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-2.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'full',
                    'hubpost_title_bar_heading_bordered'        => 0,
                    'hubpost_title_bar_heading_boxed'           => 0,
                    'hubpost_title_bar_bread_enabled'           => 1,
                    'hubpost_title_bar_bread_bordered'          => 1,
                    'hubpost_title_bar_bread_sep_style'         => 'slash',
                    'hubpost_title_bar_text_align'              => 'center',
                    'hubpost_title_bar_vertical_align'          => 'middle',
                    'hubpost_title_bar_scroll_arrow'            => 'round',
                    'hubpost_title_bar_color_style'             => 'dark',
                    'hubpost_title_bar_overlay_color'           => 'rgba(255,255,255,0.50)'
                )
            ),
            'full_bg_dark_1' => array(
                'label'   => __( 'Fullscreen title bar with dark overlay on background', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-3.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'full',
                    'hubpost_title_bar_heading_bordered'        => 0,
                    'hubpost_title_bar_heading_boxed'           => 0,
                    'hubpost_title_bar_bread_enabled'           => 1,
                    'hubpost_title_bar_bread_bordered'          => 0,
                    'hubpost_title_bar_bread_sep_style'         => 'slash',
                    'hubpost_title_bar_text_align'              => 'center',
                    'hubpost_title_bar_vertical_align'          => 'middle',
                    'hubpost_title_bar_scroll_arrow'            => 'round',
                    'hubpost_title_bar_color_style'             => 'light',
                    'hubpost_title_bar_overlay_color'           => 'rgba(0,0,0,0.6)'
                )
            ),
            'full_bg_dark_2' => array(
                'label'   => __( 'Fullscreen title bar with border around the title', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-6.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'full',
                    'hubpost_title_bar_heading_bordered'        => 1,
                    'hubpost_title_bar_heading_boxed'           => 0,
                    'hubpost_title_bar_bread_enabled'           => 0,
                    'hubpost_title_bar_bread_bordered'          => 1,
                    'hubpost_title_bar_bread_sep_style'         => 'slash',
                    'hubpost_title_bar_text_align'              => 'center',
                    'hubpost_title_bar_vertical_align'          => 'middle',
                    'hubpost_title_bar_scroll_arrow'            => 'round',
                    'hubpost_title_bar_color_style'             => 'dark',
                    'hubpost_title_bar_overlay_color'           => 'rgba(250,250,250,0.3)'
                )
            ),
            'full_bg_dark_3' => array(
                'label'   => __( 'Fullscreen title bar with dark box around the title', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-7.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'full',
                    'hubpost_title_bar_heading_bordered'        => 0,
                    'hubpost_title_bar_heading_boxed'           => 1,
                    'hubpost_title_bar_bread_enabled'           => 0,
                    'hubpost_title_bar_bread_bordered'          => 0,
                    'hubpost_title_bar_bread_sep_style'         => 'slash',
                    'hubpost_title_bar_text_align'              => 'center',
                    'hubpost_title_bar_vertical_align'          => 'middle',
                    'hubpost_title_bar_scroll_arrow'            => 'round',
                    'hubpost_title_bar_color_style'             => 'light',
                    'hubpost_title_bar_overlay_color'           => 'rgba(0,0,0,0.5)'
                )
            ),
            'normal_bg_dark_1' => array(
                'label'   => __( 'Title aligned left with dark overlay on background', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-5.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'auto',
                    'hubpost_title_bar_heading_bordered'        => 0,
                    'hubpost_title_bar_heading_boxed'           => 0,
                    'hubpost_title_bar_bread_enabled'           => 1,
                    'hubpost_title_bar_bread_bordered'          => 0,
                    'hubpost_title_bar_bread_sep_style'         => 'gt',
                    'hubpost_title_bar_text_align'              => 'left',
                    'hubpost_title_bar_vertical_align'          => 'bottom',
                    'hubpost_title_bar_scroll_arrow'            => 'none',
                    'hubpost_title_bar_color_style'             => 'light',
                    'hubpost_title_bar_overlay_color'           => 'rgba(0,0,0,0.3)'
                )
            ),
            'full_bg_dark_4' => array(
                'label'   => __( 'Tile overlaps the title area section and is aligned center', 'auxin-hubpost' ),
                'image'   => AUXIN_URL . 'images/visual-select/titlebar-style-8.svg',
                'presets' => array(
                    'hubpost_title_bar_content_width_type'      => 'boxed',
                    'hubpost_title_bar_content_section_height'  => 'auto',
                    'hubpost_title_bar_heading_bordered'        => 0,
                    'hubpost_title_bar_heading_boxed'           => 1,
                    'hubpost_title_bar_bread_enabled'           => 1,
                    'hubpost_title_bar_bread_bordered'          => 1,
                    'hubpost_title_bar_bread_sep_style'         => 'gt',
                    'hubpost_title_bar_text_align'              => 'center',
                    'hubpost_title_bar_vertical_align'          => 'bottom-overlap',
                    'hubpost_title_bar_scroll_arrow'            => 'none',
                    'hubpost_title_bar_color_style'             => 'light',
                    'hubpost_title_bar_overlay_color'           => 'rgba(0,0,0,0.5)'
                )
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Enable advanced setting', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to customize preset layouts.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_enable_customize',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
    );

    $options[] = array(
        'title'         => __( 'Content Width', 'auxin-hubpost' ),
        'description'   => '',
        'id'            => 'hubpost_title_bar_content_width_type',
        'section'       => 'hubpost-section-single-titlebar',
        'type'          => 'radio-image',
        'default'       => 'boxed',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices'       => array(
            'boxed' => array(
                'label'     => __( 'Boxed', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-content-boxed',
            ),
            'semi-full' => array(
                'label'     => __( 'Full Width Content with Space on Sides', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-content-full-with-spaces'
            ),
            'full' => array(
                'label'     => __( 'Full Width Content', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-content-full'
            )
        ),
        'transport' => 'postMessage',
        'post_js'   => '$(".page-title-section .page-header").alterClass( "aux-*-container", "aux-"+ to +"-container" );'
    );

    $options[] = array(
        'title'         => __( 'Title Section Height', 'auxin-hubpost' ),
        'description'   => '',
        'id'            => 'hubpost_title_bar_content_section_height',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'select',
        'default'       => 'auto',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices'       => array(
            'auto'  => __( 'Auto Height', 'auxin-hubpost' ),
            'full'  => __( 'Full Height', 'auxin-hubpost' )
        )
    );

    $options[] = array(
        'title'         => __( 'Vertical Position', 'auxin-hubpost' ),
        'description'   => __( 'Specifies vertical alignment of title and subtitle.', 'auxin-hubpost' ) . "<br/>".
                           __( 'Note: Parallax feature in not available for "Bottom Overlap" vertical mode.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_vertical_align',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'select',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices'            => array(
            'top'            => __( 'Top'    , 'auxin-hubpost' ),
            'middle'         => __( 'Middle' , 'auxin-hubpost' ),
            'bottom'         => __( 'Bottom' , 'auxin-hubpost' ),
            'bottom-overlap' => __( 'Bottom Overlap', 'auxin-hubpost' )
        )
    );

    $options[] = array(
        'title'         => __( 'Scroll Down Arrow', 'auxin-hubpost' ),
        'description'   => __( 'This option only applies if section height is "Full Height".', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_scroll_arrow',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'radio-image',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_content_section_height',
                 'value'   => 'full',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_vertical_align',
                 'value'   => array('top', 'middle', 'bottom'),
                 'operator'=> '=='
            )
        ),
        'choices'       => array(
            'none' => array(
                'label'     => __( 'None', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-none'
            ),
            'round' => array(
                'label'     => __( 'Round', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-scroll-down-arrow-outline'
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Display Titles', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to display title/subtitle in title section.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_title_show',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '1',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
    );

    $options[] = array(
        'title'         => __( 'Border for Heading', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to display a border around the title and subtitle area.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_heading_bordered',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_title_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
    );

    $options[] = array(
        'title'         => __( 'Boxed Title', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to wrap the title and subtitle in a box with background color.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_heading_boxed',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_title_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
    );

    $options[] = array(
        'title'         => __( 'Title Box Custom Color', 'auxin-hubpost' ),
        'description'   => __( 'Specifies a custom background color for the box around the title and subtitle.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_heading_bg_color',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'color',
        'selectors'     => ' ',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_title_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_heading_boxed',
                 'value'   => '1',
                 'operator'=> '=='
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Display Post Meta', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to display post meta information on title section.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_meta_enabled',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
    );

    $options[] = array(
        'title'         => __( 'Display Breadcrumb', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to display breadcrumb on title section.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bread_enabled',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '1',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
    );

    $options[] = array(
        'title'         => __( 'Border for Breadcrumb', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to display border around breadcrumb.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bread_bordered',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bread_enabled',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
    );

    $options[] = array(
        'title'       => __( 'Breadcrumb Separator Icon', 'auxin-hubpost' ),
        'description' => '',
        'id'          => 'hubpost_title_bar_bread_sep_style',
        'section'     => 'hubpost-section-single-titlebar',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bread_enabled',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'default'     => 'auxicon-chevron-right-1',
        'transport'   => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'        => 'icon'
    );

    $options[] = array(
        'title'         => __( 'Text Align', 'auxin-hubpost' ),
        'description'   => '',
        'id'            => 'hubpost_title_bar_text_align',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'radio-image',
        'default'       => 'left',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices'       => array(
            'left' => array(
                'label'     => __( 'Left', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-text-align-left',
            ),
            'center' => array(
                'label'     => __( 'Center', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-text-align-center'
            ),
            'right' => array(
                'label'     => __( 'Right', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-text-align-right'
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Overlay Color', 'auxin-hubpost' ),
        'description'   => __( 'The color that overlay on the background. Please note that color should have transparency.','auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_overlay_color',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'color',
        'selectors'     => ' ',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Overlay Pattern', 'auxin-hubpost' ),
        'description'   => '',
        'id'            => 'hubpost_title_bar_overlay_pattern',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'radio-image',
        'default'       => 'none',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices'       => array(
            'none' => array(
                'label'     => __( 'None', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-none'
            ),
            'hash' => array(
                'label'     => __( 'Hash', 'auxin-hubpost' ),
                'css_class' => 'axiAdminIcon-pattern',
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Overlay Pattern Opacity', 'auxin-hubpost' ),
        'description'   => '',
        'id'            => 'hubpost_title_bar_overlay_pattern_opacity',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'type'          => 'text',
        'default'       => '0.5',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_overlay_pattern',
                 'value'   => array('hash'),
                 'operator'=> '=='
            )
        ),
        'style_callback' => function( $value = null ){
            if( ! $value ){
                $value = esc_attr( auxin_get_option( 'hubpost_title_bar_overlay_pattern_opacity' ) );
            }
            if( ! is_numeric( $value ) || (float) $value > 1 ){
                $value = 1;
            }
            return $value ? ".single-hubpost .aux-overlay-bg-hash::before { opacity:$value; }" : '';
        }
    );

    $options[] = array(
        'title'         => __( 'Color Mode', 'auxin-hubpost' ),
        'description'   => '',
        'id'            => 'hubpost_title_bar_color_style',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'select',
        'default'       => 'dark',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices'       => array(
            'dark'  => __( 'Dark', 'auxin-hubpost' ),
            'light' => __( 'Light', 'auxin-hubpost' )
        )
    );

    ////////////////////////////////////////////////////////////////////////////////////////

    $options[] = array(
        'title'         => __( 'Enable Title Background', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to display custom background for title section.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_show',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Enable Parallax Effect', 'auxin-hubpost' ),
        'description'   => __( 'Enable it to have parallax background effect on this section.', 'auxin-hubpost' )."<br />".
                           __( 'Note: Parallax feature in not available for "Bottom Overlap" mode for "Vertical Position" option.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_parallax',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'switch',
        'default'       => '0',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bg_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        )
    );

    $options[] = array(
        'title'         => __( 'Background Color', 'auxin-hubpost' ),
        'description'   => __( 'Specifies a background color for title bar.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_color',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'color',
        'selectors'     => ' ',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bg_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),

    );

    $options[] = array(
        'title'         => __( 'Background Size', 'auxin-hubpost' ),
        'description'   => __( 'Specifies the background size.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_size',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'radio-image',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bg_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),
        'choices' => array(
            'auto' => array(
                'label'       => __( 'Auto', 'auxin-hubpost' ),
                'css_class'   => 'axiAdminIcon-bg-size-1',
            ),
            'contain' => array(
                'label'       => __( 'Contain', 'auxin-hubpost' ),
                'css_class'   => 'axiAdminIcon-bg-size-2',
            ),
            'cover' => array(
                'label'       => __( 'Cover', 'auxin-hubpost' ),
                'css_class'   => 'axiAdminIcon-bg-size-3',
            )
        ),

    );

    $options[] = array(
        'title'         => __( 'Background Image', 'auxin-hubpost' ),
        'description'   => __( 'Specifies a background image for title bar.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_image',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'image',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bg_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),

    );

    $options[] = array(
        'title'         => __( 'Background Video MP4', 'auxin-hubpost' ),
        'description'   => __( 'You can upload custom video for title background</br>Note: if you set custom image, default image backgrounds will be ignored.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_video_mp4',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'video',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bg_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        )

    );

    $options[] = array(
        'title'         => __( 'Background Video Ogg', 'auxin-hubpost' ),
        'description'   => __( 'You can upload custom video for title background</br>Note: if you set custom image, default image backgrounds will be ignored.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_video_ogg',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'video',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bg_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),

    );

    $options[] = array(
        'title'         => __( 'Background Video WebM', 'auxin-hubpost' ),
        'description'   => __( 'You can upload custom video for title background</br>Note: if you set custom image, default image backgrounds will be ignored.', 'auxin-hubpost' ),
        'id'            => 'hubpost_title_bar_bg_video_webm',
        'section'       => 'hubpost-section-single-titlebar',
        'transport'     => 'postMessage',
        'partial'       => array(
            'selector'              => '.single-hubpost .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'type'          => 'video',
        'default'       => '',
        'dependency'    => array(
            array(
                 'id'      => 'hubpost_title_bar_enable_customize',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_show',
                 'value'   => '1',
                 'operator'=> '=='
            ),
            array(
                 'id'      => 'hubpost_title_bar_bg_show',
                 'value'   => '1',
                 'operator'=> '=='
            )
        ),

    );


    // Sub section - related hubposts section -------------------------------

    $sections[] = array(
        'id'          => 'hubpost-section-single-related',
        'parent'      => 'hubpost-section', // section parent's id
        'title'       => __( 'Related Hubposts', 'auxin-hubpost'),
        'description' => __( 'Setting for Related Hubposts Section in Single Page', 'auxin-hubpost')
    );


    $options[] = array(
        'title'       => __( 'Display Related Hubposts', 'auxin-hubpost' ),
        'description' => __( 'Enable it to display related hubposts section on single hubpost page.' ),
        'id'          => 'show_hubpost_related_posts',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => '',
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-hubpost .aux-widget-related-posts, .single-hubpost .aux-related-btn-more").toggle( to );',
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'          => __( 'Title Typography', 'auxin-hubpost' ),
        'id'             => 'hubpost_related_posts_title_typography',
        'section'        => 'hubpost-section-single-related',
        'type'           => 'group_typography',
        'selectors'      => '.single-hubpost .aux-widget-related-posts .hentry .entry-title a',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'       => __('Label of Related Section', 'auxin-hubpost'),
        'description' => __('Specifies the label of related items section.', 'auxin-hubpost'),
        'id'          => 'hubpost_related_posts_label',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-hubpost .aux-widget-related-posts > .widget-title").html( to );',
        'default'     => __( 'Related Projects/Works', 'auxin-hubpost' ),
        'type'        => 'text'
    );

    $options[] = array(
        'title'          => __( 'Label Typography', 'auxin-hubpost' ),
        'id'             => 'hubpost_related_posts_label_typography',
        'section'        => 'hubpost-section-single-related',
        'type'           => 'group_typography',
        'selectors'      => '.single-hubpost .aux-widget-related-posts .widget-title',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'      => 'postMessage',
    );


    $options[] = array(
        'title'       => __( 'Image aspect ratio', 'auxin-hubpost' ),
        'description' => '',
        'id'          => 'hubpost_related_image_aspect_ratio',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            '0.75'          => __( 'Horizontal 4:3' , 'auxin-hubpost' ),
            '0.56'          => __( 'Horizontal 16:9', 'auxin-hubpost' ),
            '1.00'          => __( 'Square 1:1'     , 'auxin-hubpost' ),
            '1.33'          => __( 'Vertical 3:4'   , 'auxin-hubpost' )
        ),
        'transport'   => 'refresh',
        'default'     => '0.56',
    );

    $options[] =    array(
        'title'       => __('Related Items Type', 'auxin-hubpost'),
        'description' => __('Specifies the appearance type for related hubpost element.', 'auxin-hubpost'),
        'id'          => 'hubpost_related_posts_preview_mode',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'choices'     => array(
            'grid'      => 'Grid',
            'carousel'  => 'Carousel'
        ),
        'type'        => 'select',
        'default'     => 'grid'
    );

    $options[] =    array(
        'title'       => __('Number of Columns', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_related_posts_column_number',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'type'        => 'select',
        'choices'     => array(
                    '2'  => '2', '3' => '3', '4' => '4',
        ),
        'default'     => '3'
    );

    $options[] =    array(
        'title'       => __('Align Center', 'auxin-hubpost'),
        'description' => __( 'Enable it to make related hubposts section text center.'),
        'id'          => 'hubpost_related_posts_align_center',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-hubpost .aux-widget-related-posts").toggleClass( "aux-text-align-center", to );',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Full Width Related Section', 'auxin-hubpost'),
        'description' => __( 'Enable it to make related hubposts section full width.' ),
        'id'          => 'hubpost_related_posts_full_width',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-hubpost .aux-widget-related-posts").closest(".aux-container").toggleClass( "aux-fold", ! to );',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Snap Related Items', 'auxin-hubpost'),
        'description' => __( 'Enable it to remove space between related hubpost items.' ),
        'id'          => 'hubpost_related_posts_snap_items',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        // 'post_js'     => '$(".single-hubpost .aux-widget-related-posts > .aux-row").toggleClass( "aux-no-gutter", to );',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] =    array(
        'title'       => __('Display Hubpost Categories', 'auxin-hubpost'),
        'description' => __( 'Enable it to display the categories of each hubpost item in related hubposts section.'),
        'id'          => 'hubpost_related_posts_display_taxonomies',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        // 'post_js'     => '$(".single-hubpost .aux-widget-related-posts .entry-tax").toggle( to );',
        'default'     => '0',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'          => __( 'Category Terms Typography', 'auxin-hubpost' ),
        'id'             => 'hubpost_related_posts_terms_typography',
        'section'        => 'hubpost-section-single-related',
        'type'           => 'group_typography',
        'selectors'      => '.single-hubpost .aux-widget-related-posts .hentry .entry-tax a',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_related_posts_display_taxonomies',
                'value'   => array('1'),
                'operator'=> ''
           )
        ),
        'transport'      => 'postMessage',
    );

    $options[] =    array(
        'title'       => __('Display The Button Under Related Items', 'auxin-hubpost'),
        'description' => __('You can specific to show the button under related items', 'auxin-hubpost'),
        'id'          => 'hubpost_single_all_related_items_btn_display',
        'section'     => 'hubpost-section-single-related',
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-hubpost .aux-related-btn-more").toggle( to );',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            )
        ),
        'type'        => 'switch',
        'default'     => '0'
    );

    $options[] =    array(
        'title'       => __('Link the Button Under Related Items To', 'auxin-hubpost'),
        'description' => __('Whether to display a button bellow related items section in order to direct visitors to hubpost archive page or not. You can link the button to the hubpost archive page or a custom page, or hide the button.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_all_related_items_url_type',
        'section'     => 'hubpost-section-single-related',
        'transport'   => 'refresh',
        'choices'     => array(
            'hide'    => __( 'Hide it', 'auxin-hubpost' ),
            'archive' => __( 'Archive page', 'auxin-hubpost' ),
            'custom'  => __( 'Custom URL', 'auxin-hubpost' ),
        ),
        'dependency'  => array(
            array(
                 'id'       => 'hubpost_single_all_related_items_btn_display',
                 'value'    => array('1'),
            ),
            array(
                'id'      => 'show_hubpost_related_posts',
                'value'   => array('1'),
                'operator'=> ''
            )
        ),
        'type'        => 'select',
        'default'     => 'archive'
    );

    $options[] =    array(
        'title'       => __('Custom Link for Related Items Button', 'auxin-hubpost'),
        'description' => __('A custom link for the button under related items section.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_all_related_items_btn_url',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'       => 'hubpost_single_all_related_items_url_type',
                 'value'    => array('custom'),
                 'operator' => ''
            ),
            array(
                'id'       => 'hubpost_single_all_related_items_btn_display',
                'value'    => array('1'),
            ),
            array(
                'id'      => 'show_hubpost_related_posts',
                'value'   => array('1'),
                'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'type'        => 'text',
        'default'     => ''
    );

    $options[] =    array(
        'title'       => __('Custom label for Related Items Button', 'auxin-hubpost'),
        'description' => __('A custom label for the button under related items section.', 'auxin-hubpost'),
        'id'          => 'hubpost_single_all_related_items_btn_label',
        'section'     => 'hubpost-section-single-related',
        'dependency'  => array(
            array(
                 'id'       => 'hubpost_single_all_related_items_url_type',
                 'value'    => array('custom', 'archive'),
                 'operator' => ''
            ),
            array(
                'id'       => 'hubpost_single_all_related_items_btn_display',
                'value'    => array('1'),
            ),
            array(
                'id'      => 'show_hubpost_related_posts',
                'value'   => array('1'),
                'operator'=> ''
            )
        ),
        'transport'   => 'refresh',
        'type'        => 'text',
        'default'     => __( "Browse All Projects", 'auxin-hubpost' )
    );

    $options[] = array(
        'title'          => __( 'Button Typography', 'auxin-hubpost' ),
        'id'             => 'hubpost_related_posts_button_typography',
        'section'        => 'hubpost-section-single-related',
        'type'           => 'group_typography',
        'selectors'      => '.single-hubpost .aux-related-container-more .aux-related-btn-more',
        'dependency'  => array(
            array(
                 'id'      => 'show_hubpost_related_posts',
                 'value'   => array('1'),
                 'operator'=> ''
            ),
            array(
                'id'      => 'hubpost_single_all_related_items_btn_display',
                'value'   => array('1'),
                'operator'=> ''
           )
        ),
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'       => __( 'Button Background', 'auxin-hubpost' ),
        'id'          => 'hubpost_related_posts_button_bg',
        'section'     => 'hubpost-section-single-related',
        'transport'      => 'postMessage',
        'selectors'   => array(
            '.single-hubpost .aux-related-container-more .aux-related-btn-more' => 'background-image:{{VALUE}};'
        ),
        'default'   => '',
        'type'      => 'gradient'
    );

    /*$options[] = array( 'title'     => __('View All button link', 'auxin-hubpost'),
                        'description'   => __('Specifies a link for "view all" button to hubpost listing page (the button that comes at the end of latest from hubpost element ) ', 'auxin-hubpost'),
                        'id'        => 'hubpost_view_all_btn_link',
                        'section'   => 'hubpost-section-single',
                        'dependency'=> array(),
                        'default'   => home_url(),
                        'type'      => 'text' );*/



    // Sub section - hubpost Archive Page -------------------------------

    $sections[] = array(
        'id'           => 'hubpost-section-archive',
        'parent'       => 'hubpost-section', // section parent's id
        'title'        => __( 'Hubpost Page', 'auxin-hubpost'),
        'description'  => __( 'Preview Hubpost Page', 'auxin-hubpost'),
        'preview_link' => auxin_get_post_type_archive_shortlink('hubpost')
    );

    $options[] =    array(
        'title'       => __( 'Custom Page For Archive', 'auxin-hubpost' ),
        'description' => __( 'Enable this option to select custom page for archive page', 'auxin-hubpost' ),
        'id'          => 'hubpost_show_custom_archive_link',
        'section'     => 'hubpost-section-archive',
        'transport'   => 'postMessage',
        'type'        => 'switch',
        'default'     => '0'
    );

    $options[] = array(
        'title'       => __( 'Select Page', 'auxin-hubpost' ),
        'id'          => 'hubpost_custom_archive_link',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_show_custom_archive_link',
                'value'   => '1',
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => auxin_list_pages(),
        'transport'   => 'postMessage'
    );

    $options[] = array(
        'title'       => __('Hubpost Template', 'auxin-hubpost'),
        'description' => __('Choose your hubpost template.', 'auxin-hubpost'),
        'id'          => 'hubpost_index_template_type',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(),
        'transport'   => 'refresh',
        'choices'     => array(
             // default template
            'grid-1'        => array(
                'label'     => __('Grid' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/hubpost-grid.svg'
            ),
            'masonry-1'     => array(
                'label'     => __('Masonry' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/hubpost-masonry.svg'
            ),
            'tiles-1'       => array(
                'label'     => __('Tiles' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/blog-layout-11.svg'
            ),
            'land-1'        => array(
                'label'     => __('Land', 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/blog-layout-10.svg'
            )
        ),
        'type'         => 'radio-image',
        'default'      => 'grid-1'
    );

     $options[] = array(
        'title'       => __('Image Aspect Ratio', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_image_aspect_ratio',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('grid-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            '0.75'          => __('Horizontal 4:3' , 'auxin-hubpost'),
            '0.56'          => __('Horizontal 16:9', 'auxin-hubpost'),
            '1.00'          => __('Square 1:1'     , 'auxin-hubpost'),
            '1.33'          => __('Vertical 3:4'   , 'auxin-hubpost')
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => '0.56',
    );

    $options[] = array(
        'title'       => __('Hubpost Hover Type', 'auxin-hubpost'),
        'description' => __('Hover over images to see the animation.', 'auxin-hubpost'),
        'id'          => 'hubpost_archive_grid_item_type',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
                array(
                    'id'      => 'hubpost_index_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'type'        => 'radio-image',
        'choices'     => array(
             // default template
            'classic'       => array(
                'label'     => __('No animation' , 'auxin-hubpost'),
                'image'     => AUXHP_ADMIN_URL . '/assets/images/ClassicLightbox.png',
                'css_class' => 'aux-small-height'
            ),
            'classic-lightbox'     => array(
                'label'     => __('Classic with lightbox style 1' , 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/ClassicLightbox1.webm webm',
                'css_class' => 'aux-small-height'
            ),
            'classic-lightbox-boxed'       => array(
                'label'     => __('Classic with lightbox style 2' , 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/ClassicLightbox2.webm webm',
                'css_class' => 'aux-small-height'
            ),
            'overlay'       => array(
                'label'     => __('Overlay title style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle1.webm webm',
                'css_class' => 'aux-small-height'
            ),
            'overlay-boxed' => array(
                'label'     => __('Overlay title style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle2.webm webm',
                'css_class' => 'aux-small-height'
            ),
            'overlay-lightbox' => array(
                'label'     => __('Overlay title with lightbox style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox1.webm webm',
                'css_class' => 'aux-small-height'
            ),
            'overlay-lightbox-boxed' => array(
                'label'     => __('Overlay title with lightbox style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox2.webm webm',
                'css_class' => 'aux-small-height'
            )
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => 'classic',
    );

    $options[] = array(
        'title'       => __('Tile Hubpost Item Type', 'auxin-hubpost'),
        'description' => __('Hover over images to see the animation.', 'auxin-hubpost'),
        'id'          => 'hubpost_archive_tile_item_type',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
               'id'      => 'hubpost_index_template_type',
               'value'   => array('tiles-1'),
               'operator'=> '=='
            )
        ),
        'type'        => 'radio-image',
        'choices'     => array(
            'overlay'       => array(
                'label'     => __('Overlay title style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle1.webm webm'
            ),
            'overlay-boxed' => array(
                'label'     => __('Overlay title style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle2.webm webm'
            ),
            'overlay-lightbox' => array(
                'label'     => __('Overlay title with lightbox style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox1.webm webm'
            ),
            'overlay-lightbox-boxed' => array(
                'label'     => __('Overlay title with lightbox style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox2.webm webm'
            )
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => 'overlay',
    );

    $options[] = array(
        'title'       => __('Space', 'auxin-hubpost'),
        'description' => __('Specifies horizontal space between items (pixel).', 'auxin-hubpost'),
        'id'          => 'hubpost_archive_grid_space',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
                array(
                    'id'      => 'hubpost_index_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => '30',
        'type'        => 'text'
    );



    $options[] = array(
        'title'       => __('Number of Columns', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_archive_column_number',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1'  => '1', '2' => '2', '3' => '3',
                    '4'  => '4', '5' => '5', '6' => '6'
                ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => '4',
    );

    $options[] = array(
        'title'       => __( 'Custom Max Width', 'auxin-hubpost' ),
        'description' => __( 'Specifies the maximum width of website.', 'auxin-hubpost' ),
        'id'          => 'hubpost_archive_max_width_layout',
        'section'     => 'hubpost-section-archive',
        'type'        => 'select',
        'transport'   => 'postMessage',
        'dependency'  => array(),
        'choices'     => array(
            ''      => __( 'Default Site Max Width', 'auxin-hubpost' ),
            'nd'    => __( '1000 Pixels', 'auxin-hubpost' ),
            'hd'    => __( '1200 Pixels', 'auxin-hubpost' ),
            'xhd'   => __( '1400 Pixels', 'auxin-hubpost' ),
            's-fhd' => __( '1600 Pixels', 'auxin-hubpost' ),
            'fhd'   => __( '1900 Pixels', 'auxin-hubpost' )
        ),
        'post_js'   => '$( "body.post-type-archive-hubpost" ).removeClass( "aux-nd aux-hd aux-xhd aux-s-fhd aux-fhd" ).addClass( "aux-" + to ); $(window).trigger("resize");',
        'default'   => ''
    );

    $options[] = array(
        'title'       => __('Number of Columns in Tablet', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_archive_column_number_tablet',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            'inherit' => 'Inherited from larger',
            '1'  => '1', '2' => '2', '3' => '3',
            '4'  => '4', '5' => '5', '6' => '6'
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => 'inherit',
    );

    $options[] = array(
        'title'       => __('Number of Columns in Mobile', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_archive_column_number_mobile',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1' => '1' , '2' => '2', '3' => '3'
                ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => '1',
    );

    if ( auxin_is_plugin_active( 'wp-ulike/wp-ulike.php')){
        $options[] = array(
            'title'       => __('Display Like Button', 'auxin-hubpost'),
            'description' => sprintf(__('Enable it to display %s like button%s on hubpost hubposts. Please note WP Ulike plugin needs to be activaited to use this option.', 'auxin-hubpost'), '<strong>', '</strong>'),
            'id'          => 'show_hubpost_archive_like_button',
            'section'     => 'hubpost-section-archive',
            'dependency'  => array(
                array(
                    'id'      => 'hubpost_index_template_type',
                    'value'   => array('tiles-1'),
                    'operator'=> '!='
                )
            ),
            'transport'   => 'postMessage',
            'partial'     => array(
                'selector'              => '.post-type-archive-hubpost .aux-archive .content',
                'container_inclusive'   => false,
                'render_callback'       => function(){
                    auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
                }
            ),
            'default'     => '1',
            'type'        => 'switch'
        );
    }

    $options[] = array(
        'title'       => __('Enable Entry Box Coloring', 'auxin-hubpost'),
        'description' => __( 'Specifies the border/background color for entry box.', 'auxin-hubpost' ),
        'id'          => 'show_hubpost_entry_box_colors',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_archive_grid_item_type',
                'value'   => array( 'classic', 'classic-lightbox', 'classic-lightbox-boxed' ),
                'operator'=> '=='
            ),
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'transport'   => 'postMessage',
        'default'     => '0',
        'post_js'     => '$(".aux-widget-recent-hubposts .type-hubpost").toggleClass( "aux-entry-boxed", 1 == to );',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'       => __( 'Entry Box Background Color', 'auxin-hubpost' ),
        'id'          => 'hubpost_classic_entry_box_background_color',
        'description' => __( 'Specifies the background color for entry box.', 'auxin-hubpost' ),
        'section'     => 'hubpost-section-archive',
        'type'        => 'color',
        'selectors'   => '.post-type-archive-hubpost .aux-entry-boxed .entry-main',
        'placeholder' => 'background-color:{{VALUE}};',
        'dependency'  => array(
            array(
                'id'      => 'show_hubpost_entry_box_colors',
                'value'   => 1,
                'operator'=> '=='
            ),
            array(
                'id'      => 'hubpost_archive_grid_item_type',
                'value'   => array( 'classic', 'classic-lightbox', 'classic-lightbox-boxed' ),
                'operator'=> '=='
            ),
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'transport' => 'postMessage',
        'default'   => '#FFFFFF'
    );

    $options[] = array(
        'title'       => __( 'Entry Box Border Color', 'auxin-hubpost' ),
        'id'          => 'hubpost_classic_entry_box_border_color',
        'description' => __( 'Specifies the border color for entry box.', 'auxin-hubpost' ),
        'section'     => 'hubpost-section-archive',
        'type'        => 'color',
        'selectors'   => '.post-type-archive-hubpost .aux-entry-boxed .entry-main',
        'placeholder' => 'border-color:{{VALUE}} !important;',
        'dependency'  => array(
            array(
                'id'      => 'show_hubpost_entry_box_colors',
                'value'   => 1,
                'operator'=> '=='
            ),
            array(
                'id'      => 'hubpost_archive_grid_item_type',
                'value'   => array( 'classic', 'classic-lightbox', 'classic-lightbox-boxed' ),
                'operator'=> '=='
            ),
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'transport' => 'postMessage',
        'default'   => '#EAEAEA'
    );

    $options[] = array(
        'title'       => __('Enable Entry Box Coloring', 'auxin-hubpost'),
        'description' => __( 'Specifies the border/background color for entry box.', 'auxin-hubpost' ),
        'id'          => 'show_hubpost_land_side_entry_box_colors',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('land-1'),
                'operator'=> '=='
            )
        ),
        'transport'   => 'postMessage',
        'default'     => '0',
        'post_js'     => '$(".aux-hubpost-land").toggleClass( "aux-item-land", 1 == to );',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'       => __( 'Entry Box Background Color', 'auxin-hubpost' ),
        'id'          => 'hubpost_land_side_background_color',
        'description' => __( 'Specifies the background color for entry box.', 'auxin-hubpost' ),
        'section'     => 'hubpost-section-archive',
        'type'        => 'color',
        'selectors'   => '.post-type-archive-hubpost .aux-item-land .aux-land-side',
        'placeholder' => 'background-color:{{VALUE}};',
        'dependency'  => array(
            array(
                'id'      => 'show_hubpost_land_side_entry_box_colors',
                'value'   => 1,
                'operator'=> '=='
            ),
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('land-1'),
                'operator'=> '=='
            )
        ),
        'transport' => 'postMessage',
        'default'   => '#FFFFFF'
    );

    $options[] = array(
        'title'       => __( 'Entry Box Border Color', 'auxin-hubpost' ),
        'id'          => 'hubpost_land_side_border_color',
        'description' => __( 'Specifies the border color for entry box.', 'auxin-hubpost' ),
        'section'     => 'hubpost-section-archive',
        'type'        => 'color',
        'selectors'   => '.post-type-archive-hubpost .aux-item-land .aux-land-side',
        'placeholder' => 'border-color:{{VALUE}} !important;',
        'dependency'  => array(
            array(
                'id'      => 'show_hubpost_land_side_entry_box_colors',
                'value'   => 1,
                'operator'=> '=='
            ),
            array(
                'id'      => 'hubpost_index_template_type',
                'value'   => array('land-1'),
                'operator'=> '=='
            )
        ),
        'transport' => 'postMessage',
        'default'   => '#EAEAEA'
    );

    $options[] = array(
        'title'       => __('Hubpost Sidebar Position', 'auxin-hubpost'),
        'description' => __('Specifies the position of sidebar on hubpost page.', 'auxin-hubpost'),
        'id'          => 'hubpost_index_sidebar_position',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(),
        'choices'     => array(
            'no-sidebar'            => array(
                'label'             => __('No Sidebar', 'auxin-hubpost'),
                'css_class'         => 'axiAdminIcon-sidebar-none'
            ),
            'right-sidebar'         => array(
                'label'             => __('Right Sidebar', 'auxin-hubpost'),
                'css_class'         => 'axiAdminIcon-sidebar-right'
            ),
            'left-sidebar'          => array(
                'label'             => __('Left Sidebar' , 'auxin-hubpost'),
                'css_class'         => 'axiAdminIcon-sidebar-left'
            ),
            'left2-sidebar'         => array(
                'label'             => __('Left Left Sidebar' , 'auxin-hubpost'),
                'css_class'         => 'axiAdminIcon-sidebar-left-left'
            ),
            'right2-sidebar'        => array(
                'label'             => __('Right Right Sidebar' , 'auxin-hubpost'),
                'css_class'         => 'axiAdminIcon-sidebar-right-right'
            ),
            'left-right-sidebar'    => array(
                'label'             => __('Left Right Sidebar' , 'auxin-hubpost'),
                'css_class'         => 'axiAdminIcon-sidebar-left-right'
            ),
            'right-left-sidebar'    => array(
                'label'             => __('Right Left Sidebar' , 'auxin-hubpost'),
                'css_class'         => 'axiAdminIcon-sidebar-left-right'
            )
        ),
        'dependency'  => array(),
        'post_js'     => '$(".blog .aux-archive, main.aux-home").alterClass( "*-sidebar", to );',
        'type'        => 'radio-image',
        'transport'   => 'refresh',
        'default'     => 'no-sidebar'
    );

    $options[] = array(
        'title'       => __('Hubpost Sidebar Style', 'auxin-hubpost'),
        'description' => __('Specifies the style of sidebar on hubpost page.', 'auxin-hubpost'),
        'id'          => 'hubpost_index_sidebar_decoration',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                 'id'      => 'hubpost_index_sidebar_position',
                 'value'   => 'no-sidebar',
                 'operator'=> '!='
            )
        ),
        'transport'   => 'postMessage',
        'post_js'     => '$(".aux-archive").alterClass( "aux-sidebar-style-*", "aux-sidebar-style-" + to );',
        'choices'     => array(
            'simple'        => array(
                'label'     => __('Simple' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/sidebar-style-1.svg'
            ),
            'border'        => array(
                'label'     => __('Bordered Sidebar' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/sidebar-style-2.svg'
            ),
            'overlap'       => array(
                'label'     => __('Overlap Background' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/sidebar-style-3.svg'
            )
        ),
        'type'       => 'radio-image',
        'default'    => 'border'
    );

     $options[] = array(
        'title'       => __('Number of Hubposts Per Page', 'auxin-hubpost'),
        'description' => __('Specifies the number of hubposts items to show on each page.', 'auxin-hubpost'),
        'id'          => 'hubpost_archive_items_perpage',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.post-type-archive-hubpost .aux-archive .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/loop', 'hubpost' );
            }
        ),
        'default'     => '12',
        'type'        => 'text'
    );


    $options[] = array(
        'title'       => __('Display Title Bar?', 'auxin-hubpost'),
        'description' => __('Specifies whether to display the title bar at top of hubpost archive page or not.', 'auxin-hubpost'),
        'id'          => 'hubpost_archive_titlebar_enabled',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(),
        'partial'     => array(
            'selector'              => 'body.archive .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'transport'   => 'postMessage',
        'default'     => '1',
        'type'        => 'switch'
    );


    $options[] = array(
        'title'       => __('Display Breadcrumb?', 'auxin-hubpost'),
        'description' => __('Specifies whether to display the breadcrumb in title bar of hubpost archive page or not.', 'auxin-hubpost'),
        'id'          => 'hubpost_archive_titlebar_breadcrumb_enabled',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_archive_titlebar_enabled',
                'value'   => '1'
            )
        ),
        'partial'       => array(
            'selector'              => 'body.archive .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'transport'   => 'postMessage',
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'       => __('Display Title?', 'auxin-hubpost'),
        'description' => __('Specifies whether to display the title in title bar of hubpost archive page or not.', 'auxin-hubpost'),
        'id'          => 'hubpost_archive_titlebar_title_enabled',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_archive_titlebar_enabled',
                'value'   => '1'
            )
        ),
        'partial'       => array(
            'selector'              => 'body.archive .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'transport'   => 'postMessage',
        'default'     => '1',
        'type'        => 'switch'
    );

    $options[] = array(
        'title'       => __('Custom Title', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_archive_titlebar_title_context',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_archive_titlebar_enabled',
                'value'   => '1'
            )
        ),
        'partial'       => array(
            'selector'              => 'body.archive .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'transport'   => 'postMessage',
        'default'     => '',
        'type'        => 'text'
    );

    $options[] = array(
        'title'       => __('Custom Breadcrumb Label', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_archive_breadcrumb_label',
        'section'     => 'hubpost-section-archive',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_archive_titlebar_enabled',
                'value'   => '1'
            )
        ),
        'partial'       => array(
            'selector'              => 'body.archive .aux-customizer-page-title-container',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxin_the_main_title_section( array( 'has_helper_wrapper' => false ) );
            }
        ),
        'transport'   => 'postMessage',
        'default'     => __('Hubpost', 'auxin-hubpost'),
        'type'        => 'text'
    );

    // Sub section - Hubpost Taxonomy Page -------------------------------

    $sections[] = array(
        'id'          => 'hubpost-section-taxonomy',
        'parent'      => 'hubpost-section', // section parent's id
        'title'       => __( 'Hubpost Category & tag', 'auxin-hubpost'),
        'description' => __( 'Hubpost Category & tag page Setting', 'auxin-hubpost')
    );

    $options[] = array(
        'title'       => __('Taxonomy Page Template', 'auxin-hubpost'),
        'description' => 'Choose your category & tag page template.',
        'id'          => 'hubpost_taxonomy_template_type',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'choices'     => array(
             // default template
            'grid-1'             => array(
                'label'     => __('Grid' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/hubpost-grid.svg'
            ),
            'masonry-1'             => array(
                'label'     => __('Masonry' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/hubpost-masonry.svg'
            ),
            'tiles-1'             => array(
                'label'     => __('Tiles' , 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/blog-layout-11.svg'
            ),
            'land-1'       => array(
                'label'     => __('Land', 'auxin-hubpost'),
                'image'     => AUXIN_URL . 'images/visual-select/blog-layout-10.svg'
            )
        ),
        'type'          => 'radio-image',
        'default'       => 'grid-1'
    );

    $options[] = array(
        'title'       => __('Image Aspect Ratio', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_taxonomy_image_aspect_ratio',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_taxonomy_template_type',
                'value'   => array('grid-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            '0.75'          => __('Horizontal 4:3' , 'auxin-hubpost'),
            '0.56'          => __('Horizontal 16:9', 'auxin-hubpost'),
            '1.00'          => __('Square 1:1'     , 'auxin-hubpost'),
            '1.33'          => __('Vertical 3:4'   , 'auxin-hubpost')
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'default'     => '0.56',
    );

     $options[] = array(
        'title'       => __('Hubpost Hover Type', 'auxin-hubpost'),
        'description' => __('Hover over images to see the animation.', 'auxin-hubpost'),
        'id'          => 'hubpost_taxonomy_grid_item_type',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
                array(
                    'id'      => 'hubpost_taxonomy_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'type'        => 'radio-image',
        'choices'     => array(
             // default template
            'classic'       => array(
                'label'     => __('No animation' , 'auxin-hubpost'),
                'image'     => AUXHP_ADMIN_URL . '/assets/images/ClassicLightbox.png'
            ),
            'classic-lightbox'     => array(
                'label'     => __('Classic with lightbox style 1' , 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/ClassicLightbox1.webm webm'
            ),
            'classic-lightbox-boxed'       => array(
                'label'     => __('Classic with lightbox style 2' , 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/ClassicLightbox2.webm webm'
            ),
            'overlay'       => array(
                'label'     => __('Overlay title style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle1.webm webm'
            ),
            'overlay-boxed' => array(
                'label'     => __('Overlay title style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle2.webm webm'
            ),
            'overlay-lightbox' => array(
                'label'     => __('Overlay title with lightbox style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox1.webm webm'
            ),
            'overlay-lightbox-boxed' => array(
                'label'     => __('Overlay title with lightbox style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox2.webm webm'
            )
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'default'     => 'classic',
    );

     $options[] = array(
        'title'       => __('Tile Hubpost Item Type', 'auxin-hubpost'),
        'description' => __('Hover over images to see the animation.', 'auxin-hubpost'),
        'id'          => 'hubpost_taxonomy_tile_item_type',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
            array(
               'id'      => 'hubpost_taxonomy_template_type',
               'value'   => array('tiles-1'),
               'operator'=> '=='
            )
        ),
        'type'        => 'radio-image',
        'choices'     => array(
            'overlay'       => array(
                'label'     => __('Overlay title style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle1.webm webm'
            ),
            'overlay-boxed' => array(
                'label'     => __('Overlay title style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitle2.webm webm'
            ),
            'overlay-lightbox' => array(
                'label'     => __('Overlay title with lightbox style 1', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox1.webm webm'
            ),
            'overlay-lightbox-boxed' => array(
                'label'     => __('Overlay title with lightbox style 2', 'auxin-hubpost'),
                'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/OverlayTitleLightbox2.webm webm'
            )
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'default'     => 'overlay',
    );

    $options[] = array(
        'title'       => __('Space', 'auxin-hubpost'),
        'description' => __('Specifies horizontal space between items (pixel).', 'auxin-hubpost'),
        'id'          => 'hubpost_taxonomy_grid_space',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
                array(
                    'id'      => 'hubpost_taxonomy_template_type',
                    'value'   => array('grid-1', 'masonry-1'),
                    'operator'=> '=='
                )
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'default'     => '30',
        'type'        => 'text'
    );

     $options[] = array(
        'title'       => __('Number of Columns', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_taxonomy_column_number',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_taxonomy_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1'  => '1', '2' => '2', '3' => '3',
                    '4'  => '4', '5' => '5', '6' => '6'
                ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'default'     => '4',
    );

      $options[] = array(
        'title'       => __('Number of Columns in Tablet', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_taxonomy_column_number_tablet',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_taxonomy_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
            'inherit' => 'Inherited from larger',
            '1'  => '1', '2' => '2', '3' => '3',
            '4'  => '4', '5' => '5', '6' => '6'
        ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'default'     => 'inherit',
    );

    $options[] = array(
        'title'       => __('Number of Columns in Mobile', 'auxin-hubpost'),
        'description' => '',
        'id'          => 'hubpost_taxonomy_column_number_mobile',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
            array(
                'id'      => 'hubpost_taxonomy_template_type',
                'value'   => array('grid-1', 'masonry-1'),
                'operator'=> '=='
            )
        ),
        'type'        => 'select',
        'choices'     => array(
                    '1' => '1' , '2' => '2', '3' => '3'
                ),
        'transport'   => 'postMessage',
        'partial'     => array(
            'selector'              => '.aux-archive.aux-tax .content',
            'container_inclusive'   => false,
            'render_callback'       => function(){
                auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
            }
        ),
        'default'     => '1',
    );

    if ( auxin_is_plugin_active( 'wp-ulike/wp-ulike.php')){
        $options[] = array(
            'title'       => __('Display Like Button', 'auxin-hubpost'),
            'description' => sprintf(__('Enable it to display %s like button%s on hubpost hubposts. Please note WP Ulike plugin needs to be activaited to use this option.', 'auxin-hubpost'), '<strong>', '</strong>'),
            'id'          => 'show_hubpost_taxonomy_like_button',
            'section'     => 'hubpost-section-taxonomy',
            'dependency'  => array(
                array(
                    'id'      => 'hubpost_taxonomy_template_type',
                    'value'   => array('tiles-1'),
                    'operator'=> '!='
                ),

        ),
            'transport'   => 'postMessage',
            'partial'     => array(
                'selector'              => '.aux-archive.aux-tax .content',
                'container_inclusive'   => false,
                'render_callback'       => function(){
                    auxhp_get_template_part( 'theme-parts/tax', 'hubpost' );
                }
            ),
            'default'     => '1',
            'type'        => 'switch'
        );
    }

    $options[] = array(
        'title'       => __('Taxonomy Page Sidebar Position', 'auxin-hubpost'),
        'description' => 'Specifies the position of sidebar on category & tag page.',
        'id'          => 'hubpost_taxonomy_sidebar_position',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(),
        'post_js'     => '$(".archive.tag main, .archive.tax-hubpost-cat main").alterClass( "*-sidebar", to );',
        'choices'     => array(
            'no-sidebar' => array(
                'label'  => __('No Sidebar', 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-sidebar-none'
            ),
            'right-sidebar' => array(
                'label'  => __('Right Sidebar', 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-sidebar-right'
            ),
            'left-sidebar' => array(
                'label'  => __('Left Sidebar' , 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-sidebar-left'
            ),
            'left2-sidebar' => array(
                'label'  => __('Left Left Sidebar' , 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-sidebar-left-left'
            ),
            'right2-sidebar' => array(
                'label'  => __('Right Right Sidebar' , 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-sidebar-right-right'
            ),
            'left-right-sidebar' => array(
                'label'  => __('Left Right Sidebar' , 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-sidebar-left-right'
            ),
            'right-left-sidebar' => array(
                'label'  => __('Right Left Sidebar' , 'auxin-hubpost'),
                'css_class' => 'axiAdminIcon-sidebar-left-right'
            )
        ),
        'type'          => 'radio-image',
        'default'       => 'right-sidebar'
    );

    $options[] = array(
        'title'       => __('Sidebar Style', 'auxin-hubpost'),
        'description' => __('Specifies the style of sidebar on category & tag page.', 'auxin-hubpost'),
        'id'          => 'hubpost_taxonomy_archive_sidebar_decoration',
        'section'     => 'hubpost-section-taxonomy',
        'dependency'  => array(
            array(
                 'id'      => 'hubpost_taxonomy_sidebar_position',
                 'value'   => 'no-sidebar',
                 'operator'=> '!='
            )
        ),
        'post_js'    => '$(".archive.tag main, .archive.tax-hubpost-cat main").alterClass( "aux-sidebar-style-*", "aux-sidebar-style-" + to );',
        'choices'    => array(
            'simple' => array(
                'label'  => __('Simple' , 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/sidebar-style-1.svg'
            ),
            'border' => array(
                'label'  => __('Bordered Sidebar' , 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/sidebar-style-2.svg'
            ),
            'overlap' => array(
                'label'  => __('Overlap Background' , 'auxin-hubpost'),
                'image' => AUXIN_URL . 'images/visual-select/sidebar-style-3.svg'
            )
        ),
        'type'          => 'radio-image',
        'default'       => 'border'
    );

    // -------------------------------------------------------------------------

    $sections[] = array(
        'id'          => 'hubpost-section-metadata',
        'parent'      => 'hubpost-section', // section parent's id
        'title'       => __( 'Hubpost MetaData', 'auxin-hubpost'),
        'description' => __( 'Hubpost MetaData Setting', 'auxin-hubpost')
    );

    $options[] = array(
        'title'       => __('Label for Launch Project Button', 'auxin-hubpost'),
        'description' => __('Specify a label for launch project button.', 'auxin-hubpost'),
        'id'          => 'hubpost_metadata_launch_label',
        'section'     => 'hubpost-section-metadata',
        'dependency'  => array(),
        'transport'   => 'postMessage',
        'post_js'     => '$(".single-hubpost .entry-meta-data-container .aux-cta-button").html( to );',
        'type'        => 'text',
        'default'     => __( 'Launch Project', 'auxin-hubpost' )
    );

    $options[] = array(
        'title'       => __('Hubpost MetaDatas', 'auxin-hubpost'),
        'description' => __('Specify the number of fields and the label of each one for hubpost metadatas', 'auxin-hubpost'),
        'id'          => 'hubpost_metadata_list_1',
        'section'     => 'hubpost-section-metadata',
        'dependency'  => array(),
        'transport'   => 'post_js',
        'choices'     => array(
            'url'               => __( 'Project URL', 'auxin-hubpost' ),
            'client'            => __( 'Client', 'auxin-hubpost' ),
            'release_date'      => __( 'Release Date', 'auxin-hubpost' ),
            'author'            => __( 'Author', 'auxin-hubpost' ),
            'aux_custom_meta1'  => __( 'Custom Field 1', 'auxin-hubpost' ),
            'aux_custom_meta2'  => __( 'Custom Field 2', 'auxin-hubpost' ),
            'aux_custom_meta3'  => __( 'Custom Field 3', 'auxin-hubpost' ),
            'aux_custom_meta4'  => __( 'Custom Field 4', 'auxin-hubpost' ),
            'aux_custom_meta5'  => __( 'Custom Field 5', 'auxin-hubpost' ),
            'aux_custom_meta6'  => __( 'Custom Field 6', 'auxin-hubpost' ),
            'aux_custom_meta7'  => __( 'Custom Field 7', 'auxin-hubpost' ),
            'aux_custom_meta8'  => __( 'Custom Field 8', 'auxin-hubpost' ),
            'aux_custom_meta9'  => __( 'Custom Field 9', 'auxin-hubpost' ),
            'aux_custom_meta10' => __( 'Custom Field 10', 'auxin-hubpost' ),
            'aux_custom_meta11' => __( 'Custom Field 11', 'auxin-hubpost' ),
            'aux_custom_meta12' => __( 'Custom Field 12', 'auxin-hubpost' )
        ),
        'type'          => 'sortable-input',
        'default'       => '[{"id":"url", "label":"Project URL", "value":"Project URL"},{"id":"client", "label":"Client", "value":"Client"},{"id":"release_date", "label":"Release Date", "value":"Release Date"}]'
    );

    // -------------------------------------------------------------------------

    $sections[] = array(
        'id'          => 'hubpost-section-single-appearance',
        'parent'      => 'hubpost-section', // section parent's id
        'title'       => __( 'Single Hubpost Appearance', 'auxin-hubpost'),
        'description' => __( 'Single Hubpost Appearance', 'auxin-hubpost')
    );

    $options[] = array(
        'title'          => __( 'Content', 'auxin-hubpost' ),
        'id'             => 'single_hubpost_content_typography',
        'section'        => 'hubpost-section-single-appearance',
        'type'           => 'group_typography',
        'selectors'      => '.aux-single .type-hubpost .entry-content',
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'          => __( 'Overview Title', 'auxin-hubpost' ),
        'id'             => 'single_hubpost_overview_title_typography',
        'section'        => 'hubpost-section-single-appearance',
        'type'           => 'group_typography',
        'selectors'      => '.aux-single .type-hubpost .entry-side-title > h1',
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'          => __( 'Overview Content', 'auxin-hubpost' ),
        'id'             => 'single_hubpost_overview_content_typography',
        'section'        => 'hubpost-section-single-appearance',
        'type'           => 'group_typography',
        'selectors'      => '.aux-single .type-hubpost .entry-side-overview',
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'          => __( 'Meta', 'auxin-hubpost' ),
        'id'             => 'single_hubpost_meta_typography',
        'section'        => 'hubpost-section-single-appearance',
        'type'           => 'group_typography',
        'selectors'      => '.aux-single .type-hubpost .entry-meta-data dt',
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'          => __( 'Meta Terms', 'auxin-hubpost' ),
        'id'             => 'single_hubpost_meta_terms_typography',
        'section'        => 'hubpost-section-single-appearance',
        'type'           => 'group_typography',
        'selectors'      => '.aux-single .type-hubpost .entry-meta-data dd, .aux-single .type-hubpost .entry-meta-data .entry-tax > a',
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'          => __( 'Launch Button', 'auxin-hubpost' ),
        'id'             => 'single_hubpost_lunch_btn_typography',
        'section'        => 'hubpost-section-single-appearance',
        'type'           => 'group_typography',
        'selectors'      => '.aux-single .type-hubpost .entry-meta-data .aux-button',
        'transport'      => 'postMessage',
    );

    $options[] = array(
        'title'       => __( 'Launch Button Background', 'auxin-hubpost' ),
        'id'          => 'single_hubpost_lunch_btn_bg',
        'section'     => 'hubpost-section-single-appearance',
        'transport'      => 'postMessage',
        'selectors'   => array(
            '.aux-single .type-hubpost .entry-meta-data .aux-button' => 'background-image:{{VALUE}};'
        ),
        'default'   => '',
        'type'      => 'gradient'
    );

    return array( 'fields' => $options, 'sections' => $sections );
}

add_filter( 'auxin_defined_option_fields_sections', 'auxin_define_hubpost_theme_options', 13, 1 );



/**
 * Embed the
 *
 * @return [type] [description]
 */
function auxhp_init_hubpost_post_type_and_metafields(){

    // abort if phlox theme is not enabled
    if( ! defined('AUXIN_VERSION') ){
        return;
    }

    $post_type      = 'hubpost';
    $all_post_types = auxin_get_possible_post_types(true);

    // check if the post type is allowed
    if( ! empty( $all_post_types[ $post_type ] ) && $all_post_types[ $post_type ] ){

        // Initiate the post type
        include AUXHP_INC_DIR   . '/classes/class-auxhp-post-type-hubpost.php';

        $hubpost_instance = new Auxhp_Post_Type_Hubpost();
        $hubpost_instance->register();

        if( is_admin() ){
            $metabox_args['post_type']     = $post_type;
            $metabox_args['hub_id']        = 'axi_meta_hub_hubpost';
            $metabox_args['hub_title']     = __('Hubpost Options', 'auxin-hubpost' );
            $metabox_args['to_post_types'] = array( $post_type );

            auxin_maybe_render_metabox_hub_for_post_type( $metabox_args );
        }
    }

}
add_action( 'init', 'auxhp_init_hubpost_post_type_and_metafields' );


/**
 * WP ULike Customization
 *
 */

if ( auxin_is_plugin_active( 'wp-ulike/wp-ulike.php' ) ) {

    function auxhp_respond_for_liked_data( $value, $id ) {
        if( auxin_is_true( auxin_get_option( 'show_hubpost_single_like_label' ) ) ){
            return __( 'Likes', 'auxin-hubpost' ) . ' (' . $value . ')' ;
        } else {
            return $value;
        }

    }
    add_filter( 'wp_ulike_respond_for_liked_data' ,     'auxhp_respond_for_liked_data',    10 ,    2 );
    add_filter( 'wp_ulike_respond_for_not_liked_data' , 'auxhp_respond_for_liked_data',    10 ,    2 );
    add_filter( 'wp_ulike_respond_for_unliked_data' ,   'auxhp_respond_for_liked_data',    10 ,    2 );


    // function auxhp_respond_for_unliked_data( $value, $id ) {

    //     if( get_post_type( $id ) === 'hubpost' ){
    //         return __( 'Unlike', 'auxin-hubpost' ) . ' (' . $value . ')' ;
    //     } else {
    //         return $value;
    //     }

    // }
    // add_filter( 'wp_ulike_respond_for_unliked_data' ,   'auxhp_respond_for_unliked_data',  10 ,    2 );

}

// Hubpost single ------------------------------------------------------------

function auxhp_change_like_icon ( $args ) {
    $like_class = ( 'icon' == $like_type = auxin_get_option( 'hubpost_single_like_button_type', 'icon' ) ) ? ' aux-icon ' . auxin_get_option( 'hubpost_single_like_icon', 'auxicon-heart-2' ) : 'aux-has-text';

    $args['button_class'] .= ' ' . $like_class;
    if ( $like_type == 'text' ) {
        $args['button_type'] = 'text';
        $args['button_text'] = __( 'Like', 'auxin-hubpost' );
    } else {
        $args['button_type'] = 'image';
    }
    return $args;
}

/**
 * Adding share and like buttons to single hubpost actions section
 *
 * @return string
 */
function auxhp_add_single_hubpost_actions( $show_like_btn, $show_share_btn ){

    if( function_exists( 'wp_ulike' ) && $show_like_btn ){
        add_filter( 'wp_ulike_add_templates_args', 'auxhp_change_like_icon', 1, 1 );
        wp_ulike( 'get', array( 'style' => 'wpulike-heart', 'wrapper_class' => 'aux-wpulike aux-wpulike-hubpost' ) );
        remove_filter( 'wp_ulike_add_templates_args', 'auxhp_change_like_icon', 1 );
    }
    if( $show_share_btn ) {
    ?>
        <?php $share_icon = auxin_get_option( 'hubpost_single_share_button_icon', 'auxicon-share' ) ; ?>
         <div class="aux-single-hubpost-share">
             <div class="aux-tooltip-socials aux-tooltip-dark aux-socials aux-icon-left aux-medium">
                 <?php if ( auxin_get_option( 'hubpost_single_share_button_type', 'icon' ) == 'icon' ) { ?>
                    <span class="aux-icon <?php echo esc_attr( $share_icon );?>"></span>
                 <?php } ?>
                 <span class="aux-text"><?php _e( 'Share', 'auxin-hubpost' ); ?></span>
             </div>
         </div>
    <?php
    }

}
add_action( 'auxin_single_hubpost_actions', 'auxhp_add_single_hubpost_actions', 10, 2 );


/**
 * Making the hubpost overview filterable
 *
 * @param  string $overview The hubpost overview
 * @return string
 */
function auxhp_add_single_hubpost_overview( $overview ){
    echo do_shortcode( $overview );
}
add_action( 'auxin_single_hubpost_overview', 'auxhp_add_single_hubpost_overview', 10, 2 );



/**
 * Add related hubpost items to hubpost single page
 *
 * @return string
 */
function auxhp_single_hubpost_related_items( $post ){

    // get display_related option
    if( 'default' == $display_related = auxin_get_post_meta( $post, '_display_related', 'default' ) ) {
        $display_related = auxin_get_option( 'show_hubpost_related_posts', true );
    }

    if( auxin_is_true( $display_related ) || is_customize_preview() ){

        // get title_label option
        if( 'default' == $related_title_label = auxin_get_post_meta( $post, '_related_posts_label', 'default' ) ) {
            $related_title_label = auxin_get_option( 'hubpost_related_posts_label', __( 'Related Projects', 'auxin-hubpost' ) );
        }

        // get desktop_cnum option
        if( 'default' == $desktop_cnum = auxin_get_post_meta( $post, '_related_posts_column_number', 'default' ) ) {
            $desktop_cnum = auxin_get_option( 'hubpost_related_posts_column_number', true );
        }

        // get preview_mode option
        if( 'default' == $preview_mode = auxin_get_post_meta( $post, '_related_posts_preview_mode', 'default' ) ) {
            $preview_mode = auxin_get_option( 'hubpost_related_posts_preview_mode', true );
        }

        // get alignment option
        if( 'default' == $do_align_center = auxin_get_post_meta( $post, '_related_posts_align_center', 'default' ) ) {
            $do_align_center = auxin_get_option( 'hubpost_related_posts_align_center', true );
        }

        // get display_categories option
        if( 'default' == $display_categories = auxin_get_post_meta( $post, '_related_posts_display_taxonomies', 'default' ) ) {
            $display_categories = auxin_get_option( 'hubpost_related_posts_display_taxonomies', true );
        }
        $display_categories = auxin_is_true( $display_categories )? true: false;


        // set arguments
        $defaults = array(
            'title'                       => $related_title_label,
            'desktop_cnum'                => $desktop_cnum,
            'preview_mode'                => $preview_mode,
            'extra_classes'               => auxin_is_true( $do_align_center ) ? 'aux-text-align-center': '',
            'display_categories'          => $display_categories,
            'exclude'                     => $post->ID,
            'container_start_tag'         => '<div class="aux-container aux-related-container aux-fold">',
        );
        echo auxhp_get_hubpost_related_posts( $defaults );
    }

}



/**
 *  Adds a button under related items which links to more related items
 *
 * @param  object $post The post object
 * @return void
 */
function auxhp_single_hubpost_show_all_hubposts( $post ){

    $btn_display = auxin_get_post_meta( $post, '_related_posts_all_items_btn_display', 'default' ) ;
    $btn_display = 'default' === $btn_display ?  auxin_get_option( "hubpost_single_all_related_items_btn_display", "1" )  : $btn_display ;

    $btn_url_type = auxin_get_post_meta( $post, '_related_posts_all_items_url_type', 'default' ) ;
    $btn_url_type = 'default' === $btn_url_type ?  auxin_get_option( "hubpost_single_all_related_items_url_type", 'hide' )  : $btn_url_type ;


    if( "custom" ===  $btn_url_type ){

        $hubpost_link = auxin_get_post_meta( $post, '_related_posts_all_items_url_type_custom', '' ) ;
        $hubpost_link = empty( $hubpost_link ) ? auxin_get_option( "hubpost_single_all_related_items_btn_url", "" ) : $hubpost_link ;

    } else {
        $hubpost_link  = get_post_type_archive_link( "hubpost" );
    }

    $hubpost_label = auxin_get_post_meta( $post, '_related_posts_all_items_btn_label', '' ) ;
    $hubpost_label = empty( $hubpost_label ) ? auxin_get_option( "hubpost_single_all_related_items_btn_label", "" ) : $hubpost_label ;

    if( ! empty( $hubpost_label ) && auxin_is_true( $btn_display ) ){
?>
    <div class="aux-container aux-related-container-more aux-fold">
        <a href="<?php echo esc_url( $hubpost_link ); ?>" class="aux-button aux-cta-button aux-shamrock aux-exlarge aux-curve aux-related-btn-more" target="_blank">
            <span class="aux-overlay"></span>
            <span class="aux-text"><?php echo esc_attr( $hubpost_label ); ?></span>
        </a>
    </div>
<?php
    }
}


/**
 *  Add Related Hubposts to Wrappers Based on Our Conditions
 *
 * @return void
 */

 function auxhp_related_hubposts_location(){

    if ( is_single() ){

        global $post;

        $sticky_sidebar = auxin_get_post_meta( $post, '_sticky_sidebar', 'default' );
        $sticky_sidebar = 'default' === $sticky_sidebar ? auxin_get_option( 'hubpost_single_sticky_sidebar', false ) : $sticky_sidebar;
        $info_layout_bg = auxin_get_post_meta( $post, '_side_info_color' );

        if ( auxin_is_true( $sticky_sidebar ) || ! empty( $info_layout_bg ) ) {
            add_action( 'auxin_hubpost_single_after_article_primary', 'auxhp_single_hubpost_related_items' );
            add_action( 'auxin_hubpost_single_after_article_primary', 'auxhp_single_hubpost_show_all_hubposts' );
        } else {
            add_action( 'auxin_hubpost_single_after_content_primary', 'auxhp_single_hubpost_related_items' );
            add_action( 'auxin_hubpost_single_after_content_primary', 'auxhp_single_hubpost_show_all_hubposts' );
        }

    }

}

add_action( 'wp', 'auxhp_related_hubposts_location');
/**
 * Changes the default hubpost layout to "no-sidebar"
 *
 * @return string   Hubpost single page layout
 */
function auxhp_single_hubpost_no_sidebar( $layout, $post ){
    if( "hubpost" == get_post_type( $post ) && !is_post_type_archive( 'hubpost' ) && !is_tax( [ 'hubpost-cat', 'hubpost-tag'] ) ) {
        return "no-sidebar";
    }
    return $layout;
}
add_filter( "auxin_get_page_sidebar_pos", "auxhp_single_hubpost_no_sidebar", 10, 2 );

/**
 * Exclude the posts without media in hubpost archive page query
 *
 * @return Void
 */
function auxhp_exclude_posts_without_media( $query ){

    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'hubpost' ) && ! in_array( auxin_get_option( 'hubpost_index_template_type', 'grid-1'), array( 'land-1' ) ) ) {

        $meta_query = array(
                         array(
                            'key'     => '_thumbnail_id',
                            'value'   => '',
                            'compare' => '!='
                        ),
                    );

        $query->set( 'meta_query', $meta_query );
    }

}
add_action('pre_get_posts','auxhp_exclude_posts_without_media');

/** 
 * Add hubpost active post type
 *
 * @param  array $active_post_types  The list of allowed post types
 * @return array
 */
function auxhp_allow_hubpost_active_post_types( $active_post_types ){
    $active_post_types['hubpost'] = true;

    return $active_post_types;
}
add_filter( 'auxin_active_post_types', 'auxhp_allow_hubpost_active_post_types' );
