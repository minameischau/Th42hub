<?php
namespace Auxin\Plugin\Hubpost\Elementor\Elements;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Files\CSS\Post;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Elementor 'Recent_Hubposts_Tile_Carousel' widget.
 *
 * Elementor widget that displays an 'Recent_Hubposts_Tile_Carousel' with lightbox.
 *
 * @since 1.0.0
 */
class Recent_Hubposts_Tile_Carousel_Carousel extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve 'Recent_Hubposts_Tile_Carousel' widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'aux_recent_hubposts_tile_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve 'Recent_Hubposts_Tile_Carousel' widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Tiles Carousel Hubposts', 'auxin-hubpost' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve 'Recent_Hubposts_Tile_Carousel' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-carousel auxin-badge';
    }

    /**
     * Get widget categories.
     *
     * Retrieve 'Recent_Hubposts_Tile_Carousel' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_categories() {
        return array( 'auxin-hubpost' );
    }

    /**
     * Retrieve the terms in a given taxonomy or list of taxonomies.
     *
     * Retrieve 'Recent_Hubposts_Tile_Carousel' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_terms() {
        // Get terms
        $terms = get_terms(
            array(
                'taxonomy'   => 'hubpost-cat',
                'orderby'    => 'count',
                'hide_empty' => true
            )
        );

        // Then create a list
        $list  = array( ' ' => __('All Categories', 'auxin-hubpost' ) ) ;

        if ( ! is_wp_error( $terms ) && is_array( $terms ) ){
            foreach ( $terms as $key => $value ) {
                $list[$value->term_id] = $value->name;
            }
        }

        return $list;
    }

    /**
     * Register 'Recent_Hubposts_Tile_Carousel' widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        /*-------------------------------------------------------------------*/
        /*  Layout TAB
        /*-------------------------------------------------------------------*/

        /*  Layout Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'layout_section',
            array(
                'label' => __('Layout', 'auxin-hubpost' ),
                'tab'   => Controls_Manager::TAB_LAYOUT
            )
        );

        $this->add_control(
            'tile_style_pattern',
            array(
                'label'       => __('Post tile styles','auxin-hubpost' ),
                'description' => __('Move your mouse over each item in order to preview the hover effect.','auxin-hubpost' ),
                'style_items' => 'max-width:31%;',
                'type'        => 'aux-visual-select',
                'options'     => array(
                    'default'    => array(
                        'label'    => __( 'Default', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-5.svg'
                    ),
                    'pattern-1'  => array(
                        'label'    => __( 'Pattern 1', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-3.svg'
                    ),
                    'pattern-2'  => array(
                        'label'    => __( 'Pattern 2', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-6.svg'
                    ),
                    'pattern-3'  => array(
                        'label'    => __( 'Pattern 3', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-7.svg'
                    ),
                    'pattern-4'  => array(
                        'label'    => __( 'Pattern 4', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-8.svg'
                    ),
                    'pattern-5'  => array(
                        'label'    => __( 'Pattern 5', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-4.svg'
                    ),
                    'pattern-6'  => array(
                        'label'    => __('Pattern 6', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-1.svg'
                    ),
                    'pattern-7'  => array(
                        'label'    => __('Pattern 7', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-2.svg'
                    ),
                    'pattern-8'  => array(
                        'label'    => __('Pattern 8', 'auxin-hubpost' ),
                        'image'    => AUXELS_ADMIN_URL . '/assets/images/visual-select/tile-2.svg'
                    )
                ),
                'default'  => 'default'
            )
        );

        $this->add_control(
            'display_title',
            array(
                'label'        => __('Display title', 'auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'show_info',
            array(
                'label'        => __('Insert hubpost meta','auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'deeplink',
            array(
                'label'        => __('Deeplink', 'auxin-hubpost' ),
                'description'  => __('Enables the deeplink feature, it updates URL based on page and filter status.', 'auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'default'      => 'no'
            )
        );

        $this->add_control(
            'deeplink_slug',
            array(
                'label'       => __('Deeplink slug', 'auxin-hubpost' ),
                'description' => __('Specifies the deeplink slug value in address bar.', 'auxin-hubpost' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'condition'   => array(
                    'deeplink' => 'yes'
                )
            )
        );

        $this->end_controls_section();

        /*  Carousel Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'carousel_section',
            array(
                'label' => __('Carousel', 'auxin-hubpost' ),
                'tab'   => Controls_Manager::TAB_LAYOUT
            )
        );

        $this->add_control(
            'carousel_navigation_control',
            array(
                'label'       => __('Navigation control', 'auxin-hubpost'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'bullets',
                'options'     => array(
                    ''        => __('None', 'auxin-hubpost'),
                    'arrows'  => __('Arrows', 'auxin-hubpost'),
                    'bullets' => __('Bullets', 'auxin-hubpost')
                )
            )
        );

        $this->add_control(
            'button_style',
            array(
                'label'       => __('Button Navigation Style','auxin-hubpost' ),
                'type'        => 'aux-visual-select',
                'default'     => 'pattern-1',
                'options'     => array(
                    'pattern-1'            => array(
                        'label' => __('Pattern 1', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/button-normal.svg'
                    ),
                    'pattern-2' => array(
                        'label' => __('Pattern 2', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/button-curved.svg'
                    )
                ),
                'condition'   => array(
                    'carousel_navigation_control' => array( 'arrows' ),
                )
            )
        );

        $this->add_control(
            'carousel_navigation',
            array(
                'label'       => __('Navigation type', 'auxin-hubpost'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'peritem',
                'options'     => array(
                   'peritem' => __('Move per column', 'auxin-hubpost'),
                   'perpage' => __('Move per page', 'auxin-hubpost'),
                   'scroll'  => __('Smooth scroll', 'auxin-hubpost')
                )
            )
        );

        $this->add_control(
            'carousel_loop',
            array(
                'label'        => __('Loop navigation','auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'carousel_autoplay',
            array(
                'label'        => __('Autoplay carousel','auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'return_value' => 'yes',
                'default'      => ''
            )
        );

        $this->add_control(
            'carousel_autoplay_delay',
            array(
                'label'       => __( 'Autoplay delay', 'auxin-hubpost' ),
                'description' => __('Specifies the delay between auto-forwarding in seconds.', 'auxin-hubpost' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '2'
            )
        );

        $this->end_controls_section();

        /*-------------------------------------------------------------------*/
        /*  Content TAB
        /*-------------------------------------------------------------------*/

        /*  Query Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'query_section',
            array(
                'label'      => __('Query', 'auxin-hubpost' ),
            )
        );

        $this->add_control(
            'cat',
            array(
                'label'       => __('Categories', 'auxin-hubpost'),
                'description' => __('Specifies a category that you want to show posts from it.', 'auxin-hubpost' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => $this->get_terms(),
                'default'     => array( ' ' ),
            )
        );

        $this->add_control(
            'num',
            array(
                'label'       => __('Number of hubposts to show in per page', 'auxin-hubpost'),
                'description' => __('Leave it empty to show all items', 'auxin-hubpost'),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '5',
                'min'         => 1,
                'step'        => 1
            )
        );

        $this->add_control(
            'page',
            array(
                'label'       =>  __('Number of Pages', 'auxin-hubpost'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '2',
                'min'         => 1,
                'step'        => 1
            )
        );

        $this->add_control(
            'exclude_without_media',
            array(
                'label'        => __('Exclude hubposts without media','auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'order_by',
            array(
                'label'       => __('Order by', 'auxin-hubpost'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'date',
                'options'     => array(
                    'date'            => __('Date', 'auxin-hubpost'),
                    'menu_order date' => __('Menu Order', 'auxin-hubpost'),
                    'title'           => __('Title', 'auxin-hubpost'),
                    'ID'              => __('ID', 'auxin-hubpost'),
                    'rand'            => __('Random', 'auxin-hubpost'),
                    'comment_count'   => __('Comments', 'auxin-hubpost'),
                    'modified'        => __('Date Modified', 'auxin-hubpost'),
                    'author'          => __('Author', 'auxin-hubpost'),
                    'post__in'        => __('Inserted Post IDs', 'auxin-hubpost')
                ),
            )
        );

        $this->add_control(
            'order',
            array(
                'label'       => __('Order', 'auxin-hubpost'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'DESC',
                'options'     => array(
                    'DESC'          => __('Descending', 'auxin-hubpost'),
                    'ASC'           => __('Ascending', 'auxin-hubpost'),
                ),
            )
        );

        $this->add_control(
            'only_posts__in',
            array(
                'label'       => __('Only hubposts','auxin-hubpost' ),
                'description' => __('If you intend to display ONLY specific hubposts, you should specify the hubposts here. You have to insert the post IDs that are separated by comma (eg. 53,34,87,25).', 'auxin-hubpost' ),
                'type'        => Controls_Manager::TEXT
            )
        );

        $this->add_control(
            'include',
            array(
                'label'       => __('Include hubposts','auxin-hubpost' ),
                'description' => __('If you intend to include additional hubposts, you should specify the hubposts here. You have to insert the Post IDs that are separated by comma (eg. 53,34,87,25)', 'auxin-hubpost' ),
                'type'        => Controls_Manager::TEXT
            )
        );

        $this->add_control(
            'exclude',
            array(
                'label'       => __('Exclude hubposts','auxin-hubpost' ),
                'description' => __('If you intend to exclude specific hubposts from result, you should specify the hubposts here. You have to insert the Post IDs that are separated by comma (eg. 53,34,87,25)', 'auxin-hubpost' ),
                'type'        => Controls_Manager::TEXT
            )
        );

        $this->add_control(
            'offset',
            array(
                'label'       => __('Start offset','auxin-hubpost' ),
                'description' => __('Number of hubposts to display or pass over.', 'auxin-hubpost' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => ''
            )
        );

        $this->end_controls_section();

        /*-------------------------------------------------------------------*/
        /*  Style TAB
        /*-------------------------------------------------------------------*/

        /*  Tile Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'tiles_style_section',
            array(
                'label'     => __( 'Hover', 'auxin-hubpost' ),
                'tab'       => Controls_Manager::TAB_STYLE
            )
        );

        $this->add_control(
            'item_style',
            array(
                'label'       =>  __('Tiles hover type','auxin-hubpost' ),
                'type'        => 'aux-visual-select',
                'default'     => 'overlay',
                'style_items' => 'max-width:200px;',
                'options'     => array(
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
                )
            )
        );

        $this->add_control(
            'tile_hover_background',
            array(
                'label' => __( 'Tiles Hover Background', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .entry-media::after' => 'background-color: {{VALUE}};',
                )
            )
        );

        $this->end_controls_section();

        /*  Title Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'title_style_section',
            array(
                'label'      => __( 'Title', 'auxin-hubpost' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => array(
                    'relation' => 'or',
                    'terms'    => array(
                        array(
                            'name'     => 'display_title',
                            'operator' => '===',
                            'value'    => 'yes',
                        )
                    ),
                ),
            )
        );

        // Title heading

        $this->start_controls_tabs( 'title_colors' );

        $this->start_controls_tab(
            'title_color_normal',
            array(
                'label' => __( 'Normal' , 'auxin-hubpost' ),
                'condition' => array(
                    'display_title' => 'yes'
                )
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .entry-header .entry-title a' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_title' => 'yes'
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_color_hover',
            array(
                'label' => __( 'Hover' , 'auxin-hubpost' ),
                'condition' => array(
                    'display_title' => 'yes'
                )
            )
        );

        $this->add_control(
            'title_hover_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .entry-header .entry-title a:hover' => 'color:{{VALUE}};',
                ),
                'condition' => array(
                    'display_title' => 'yes'
                )
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'title_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-header .entry-title a',
                'condition' => array(
                    'display_title' => 'yes'
                )
            )
        );

        $this->add_responsive_control(
            'title_margin_bottom',
            array(
                'label' => __( 'Bottom space', 'auxin-hubpost' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .entry-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'display_title' => 'yes'
                )
            )
        );

        $this->end_controls_section();


        /*  Meta Info Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'info_style_section',
            array(
                'label'      => __( 'Meta Info', 'auxin-hubpost' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => array(
                    'relation' => 'or',
                    'terms'    => array(
                        array(
                            'name'     => 'show_info',
                            'operator' => '===',
                            'value'    => 'yes',
                        )
                    ),
                ),
            )
        );

        $this->start_controls_tabs( 'info_colors' );

        $this->start_controls_tab(
            'info_color_normal',
            array(
                'label'     => __( 'Normal' , 'auxin-hubpost' ),
                'condition' => array(
                    'show_info' => 'yes'
                )
            )
        );

        $this->add_control(
            'info_color',
            array(
                'label'     => __( 'Color', 'auxin-hubpost' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .entry-tax a' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'show_info' => 'yes'
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'info_color_hover',
            array(
                'label' => __( 'Hover' , 'auxin-hubpost' ),
                'condition' => array(
                    'show_info' => 'yes'
                )
            )
        );

        $this->add_control(
            'info_hover_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .entry-tax a:hover' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'show_info' => 'yes'
                )
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'info_typography',
                'scheme'    => Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .entry-tax',
                'condition' => array(
                    'show_info' => 'yes'
                )
            )
        );

        $this->add_responsive_control(
            'info_margin_bottom',
            array(
                'label' => __( 'Bottom space', 'auxin-hubpost' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 100
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} .entry-tax' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ),
                'condition' => array(
                    'show_info' => 'yes'
                )
            )
        );

        $this->add_responsive_control(
            'info_spacing_between',
            array(
                'label' => __( 'Space between metas', 'auxin-hubpost' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 30
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} .entry-tax a:after' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}};'
                )
            )
        );

        $this->end_controls_section();

        // Auxin hook for registering general controls
        do_action( 'auxin/elementor/register_controls', $this );
    }

    /**
     * Render image box widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $args = array(
            // Layout section
            'tile_style_pattern'          => $settings['tile_style_pattern'],
            'display_title'               => $settings['display_title'],
            'show_info'                   => $settings['show_info'],
            'deeplink'                    => $settings['deeplink'],
            'deeplink_slug'               => $settings['deeplink_slug'],

            // Carousel section
            'carousel_navigation'         => $settings['carousel_navigation'],
            'button_style'                => $settings['button_style'],
            'carousel_navigation_control' => $settings['carousel_navigation_control'],
            'carousel_loop'               => $settings['carousel_loop'],
            'carousel_autoplay'           => $settings['carousel_autoplay'],
            'carousel_autoplay_delay'     => $settings['carousel_autoplay_delay'],

            // Query section
            'cat'                         => $settings['cat'],
            'num'                         => $settings['num'],
            'page'                        => $settings['page'],
            'only_posts__in'              => $settings['only_posts__in'],
            'include'                     => $settings['include'],
            'exclude'                     => $settings['exclude'],
            'offset'                      => $settings['offset'],
            'order_by'                    => $settings['order_by'],
            'order'                       => $settings['order'],
            'exclude_without_media'       => $settings['exclude_without_media'],

            'item_style'                  => $settings['item_style'],
            'tile_skin'                   => 'darken',

        );

        echo auxin_widget_recent_hubposts_tiles_carousel_callback( $args );
    }

}
