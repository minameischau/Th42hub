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
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Elementor 'Recent_Hubposts_Grid' widget.
 *
 * Elementor widget that displays an 'Recent_Hubposts_Grid' with lightbox.
 *
 * @since 1.0.0
 */
class Recent_Hubposts_Grid extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve 'Recent_Hubposts_Grid' widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'aux_recent_hubposts_grid';
    }

    /**
     * Get widget title.
     *
     * Retrieve 'Recent_Hubposts_Grid' widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Grid Hubposts', 'auxin-hubpost' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve 'Recent_Hubposts_Grid' widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-grid auxin-badge';
    }

    /**
     * Get widget categories.
     *
     * Retrieve 'Recent_Hubposts_Grid' widget icon.
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
     * Retrieve 'Recent_Hubposts_Grid' widget icon.
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
        $list  = array();

        if ( ! is_wp_error( $terms ) && is_array( $terms ) ){
            foreach ( $terms as $key => $value ) {
                $list[$value->term_id] = $value->name;
            }
        }

        return $list;
    }

    /**
     * Register 'Recent_Hubposts_Grid' widget controls.
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

        $this->start_controls_section(
            'layout_section',
            array(
                'label' => __('Layout', 'auxin-hubpost' ),
                'tab'   => Controls_Manager::TAB_LAYOUT
            )
        );

        $this->add_responsive_control(
            'columns',
            array(
                'label'          => __( 'Columns', 'auxin-hubpost' ),
                'type'           => Controls_Manager::SELECT,
                'default'        => '4',
                'tablet_default' => 'inherit',
                'mobile_default' => '1',
                'options'        => array(
                    'inherit' => __( 'Inherited from larger', 'auxin-hubpost' ),
                    '1'       => '1',
                    '2'       => '2',
                    '3'       => '3',
                    '4'       => '4',
                    '5'       => '5',
                    '6'       => '6'
                ),
                'frontend_available' => true
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
                'label'        => __('Display categories','auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'display_read_more',
            array(
                'label'        => __('Display Read More', 'auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'return_value' => 'yes',
                'default'      => 'no'
            )
        );

        $this->add_control(
            'display_like',
            array(
                'label'        => __('Display like button', 'auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'default'      => 'no'
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

        $this->add_control(
            'use_ajax',
            array(
                'label'        => __('Ajax Compatibility', 'auxin-hubpost' ),
                'description'  => __('Using the Ajax feature Makes the performance better', 'auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'default'      => 'no'
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
                'description' => __('Specifies a category that you want to show posts from it. In order to choose the all categories leave the field empty', 'auxin-hubpost' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => $this->get_terms(),
                'default'     => array(),
            )
        );

        $this->add_control(
            'num',
            array(
                'label'       => __('Number of posts to show', 'auxin-hubpost'),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'min'         => 1,
                'step'        => 1
            )
        );

        $this->add_control(
            'exclude_without_media',
            array(
                'label'        => __('Exclude posts without media','auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
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
        /*  Settings TAB
        /*-------------------------------------------------------------------*/

        /*  Filters Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'filters_section',
            array(
                'label'      => __('Filters', 'auxin-hubpost' ),
                'tab'        => Controls_Manager::TAB_SETTINGS
            )
        );

        $this->add_control(
            'show_filters',
            array(
                'label'        => __('Display filters','auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'filter_by',
            array(
                'label'       => __('Filter By', 'auxin-hubpost'),
                'description' => __('Filter by categories or tags', 'auxin-hubpost' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'hubpost-cat',
                'options'     => array(
                    'hubpost-filter'  => __('Filter', 'auxin-hubpost'),
                    'hubpost-cat'     => __('Category', 'auxin-hubpost'),
                    'hubpost-tag'     => __('Tag', 'auxin-hubpost')
                ),
                'condition' => array(
                    'show_filters' => 'yes'
                )
            )
        );

        $this->add_control(
            'filter_align',
            array(
                'label'       => __('Alignment', 'auxin-hubpost'),
                'description' => __('Set the alignment for filters', 'auxin-hubpost' ),
                'type'        => Controls_Manager::CHOOSE,
                'style_items' => 'max-width:30%;',
                'default'     => 'aux-left',
                'options'     => array(
                    'aux-left' => array(
                        'title' => __( 'Left', 'auxin-hubpost' ),
                        'icon'  => 'eicon-text-align-left',
                    ),
                    'aux-center' => array(
                        'title' => __( 'Center', 'auxin-hubpost' ),
                        'icon'  => 'eicon-text-align-center',
                    ),
                    'aux-right' => array(
                        'title' => __( 'Right', 'auxin-hubpost' ),
                        'icon'  => 'eicon-text-align-right',
                    )
                ),
                'devices'      => array('desktop'),
                'condition'    => array(
                    'show_filters' => 'yes'
                )
            )
        );

        $this->add_control(
            'filter_style',
            array(
                'label'       => __('Filter Button Style', 'auxin-hubpost'),
                'description' => __('Style of filter buttons.', 'auxin-hubpost' ),
                'type'        => 'aux-visual-select',
                'default'     => 'aux-slideup',
                'options'     => array(
                    'aux-slideup'      => array(
                        'label'     => __('Slide up' , 'auxin-hubpost'),
                        'video_src'     => AUXHP_ADMIN_URL . '/assets/images/preview/FilterSlideUp2.webm webm'
                    ),
                    'aux-fill'    => array(
                        'label'     => __('Fill' , 'auxin-hubpost'),
                        'video_src' => AUXHP_ADMIN_URL . '/assets/images/preview/FilterFill.webm webm'
                    ),
                    'aux-cube'     => array(
                        'label'     => __('Cube' , 'auxin-hubpost'),
                        'video_src'     => AUXHP_ADMIN_URL . '/assets/images/preview/FilterCube.webm webm'
                    ),
                    'aux-underline'     => array(
                        'label'     => __('Underline' , 'auxin-hubpost'),
                        'video_src'     => AUXHP_ADMIN_URL . '/assets/images/preview/FilterUnderline.mp4 mp4'
                    ),
                    'aux-overlay'    => array(
                        'label'     => __('Float frame' , 'auxin-hubpost'),
                        'video_src'     => AUXHP_ADMIN_URL . '/assets/images/preview/FilterFloatFrame.webm webm'
                    ),
                    'aux-bordered'     => array(
                        'label'     => __('Borderd' , 'auxin-hubpost'),
                        'video_src'     => AUXHP_ADMIN_URL . '/assets/images/preview/FilterBordered.mp4 mp4'
                    ),
                    'aux-overlay aux-underline-anim'     => array(
                        'label'     => __('Float underline' , 'auxin-hubpost'),
                        'video_src'     => AUXHP_ADMIN_URL . '/assets/images/preview/FilterUnderline.webm webm'
                    ),
                    'aux-dropdown-filter'     => array(
                        'label'     => __('DropDown' , 'auxin-hubpost'),
                        'video_src'     => AUXHP_ADMIN_URL . '/assets/images/preview/FilterUnderline.webm webm'
                    )
                ),
                'condition' => array(
                    'show_filters' => 'yes'
                )
            )
        );

        $this->start_controls_tabs( 
            'filters_colors',
            array(
                'condition' => array(
                    'filter_style!' => 'aux-dropdown-filter',
                )
            )
        );

        $this->start_controls_tab(
            'filters_color_normal',
            array(
                'label' => __( 'Normal' , 'auxin-hubpost' )
            )
        );

        $this->add_control(
            'filters_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .aux-filters:not(.aux-slideup) li > a span, {{WRAPPER}} .aux-filters.aux-slideup li > a span:before' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'filters_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .aux-filters li > a'
            )
        );

        $this->add_responsive_control(
            'filters_padding',
            array(
                'label'      => __( 'Padding', 'auxin-hubpost' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .aux-filters li > a > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filters_color_hover',
            array(
                'label' => __( 'Hover' , 'auxin-hubpost' )
            )
        );

        $this->add_control(
            'filters_hover_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .aux-filters:not(.aux-slideup) li:hover > a span, {{WRAPPER}} .aux-filters.aux-slideup li:hover > a span:before' => 'color: {{VALUE}};',
                )
            )
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'filters_hover_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .aux-filters li:hover > a'
            )
        );

        $this->add_responsive_control(
            'filters_hover_padding',
            array(
                'label'      => __( 'Padding', 'auxin-hubpost' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .aux-filters li:hover > a > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filters_color_active',
            array(
                'label' => __( 'Active' , 'auxin-hubpost' )
            )
        );

        $this->add_control(
            'filters_active_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .aux-filters li > a.aux-selected span:after, {{WRAPPER}} .aux-filters:not(.aux-slideup) li > a.aux-selected span' => 'color: {{VALUE}};',
                )
            )
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'filters_active_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .aux-filters li > a.aux-selected'
            )
        );

        $this->add_responsive_control(
            'filters_active_padding',
            array(
                'label'      => __( 'Padding', 'auxin-hubpost' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .aux-filters li > a.aux-selected > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                )
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /*  Transition Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'transition_section',
            array(
                'label'     => __('Transition', 'auxin-hubpost' ),
                'tab'       => Controls_Manager::TAB_SETTINGS
            )
        );

        $this->add_control(
            'reveal_transition_duration',
            array(
                'label'       => __('Transition duration on reveal','auxin-hubpost' ),
                'description' => __('The transition duration while the element is going to be displayed (milliseconds).'),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '600'
            )
        );

        $this->add_control(
            'reveal_between_delay',
            array(
                'label'       => __('Delay between reveal','auxin-hubpost' ),
                'description' => __('The delay between each sequence of revealing transitions (milliseconds).'),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '60'
            )
        );

        $this->add_control(
            'hide_transition_duration',
            array(
                'label'       => __('Transition duration on hide','auxin-hubpost' ),
                'description' => __('The transition duration while the element is going to be hidden (milliseconds).'),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '600'
            )
        );

        $this->add_control(
            'hide_between_delay',
            array(
                'label'       => __('Delay between hide','auxin-hubpost' ),
                'description' => __('The delay between each sequence of hiding transitions (milliseconds).'),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '30'
            )
        );

        $this->end_controls_section();

        /*  Pagination Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'paginate_section',
            array(
                'label'      => __('Paginate', 'auxin-hubpost' ),
                'tab'       => Controls_Manager::TAB_SETTINGS
            )
        );

        $this->add_control(
            'paginate',
            array(
                'label'        => __('Paginate','auxin-hubpost' ),
                'description'  => __('Paginates the hubpost items', 'auxin-hubpost' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'auxin-hubpost' ),
                'label_off'    => __( 'Off', 'auxin-hubpost' ),
                'default'      => 'yes'
            )
        );

        $this->add_control(
            'perpage',
            array(
                'label'       => __('Items number perpage', 'auxin-hubpost' ),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '8',
                'condition'   => array(
                    'paginate' => 'yes'
                )
            )
        );

        $this->add_control(
            'loadmore_type',
            array(
                'label'       => __('Load More Type','auxin-hubpost' ),
                'type'        => 'aux-visual-select',
                'options'     => array(
                    ''      => array(
                        'label' => __('None', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-none.svg'
                    ),
                    'scroll' => array(
                        'label' => __('Infinite Scroll', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-infinite.svg'
                    ),
                    'next'   => array(
                        'label' => __('Next Button', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-button.svg'
                    ),
                    'next-prev'  => array(
                        'label' => __('Next Prev', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-next-prev.svg'
                    )
                ),
                'default'     => '',
                'condition'   => array(
                    'paginate!' => 'yes'
                )
            )
        );

        $this->add_control(
            'loadmore_label',
            array(
                'label'     => __('Load More Label', 'auxin-hubpost' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'text',
                'options'   => array(
                    'text'       => __('Text', 'auxin-hubpost'),
                    'arrow'      => __('Arrow', 'auxin-hubpost'),
                    'text-arrow' => __('Text & Arrow', 'auxin-hubpost')
                ),
                'condition' => array(
                    'paginate!' => 'yes'
                )
            )
        );

        $this->end_controls_section();

        /*-------------------------------------------------------------------*/
        /*  Style TAB
        /*-------------------------------------------------------------------*/

        /*  Image Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'image_style_section',
            array(
                'label'     => __( 'Image', 'auxin-hubpost' ),
                'tab'       => Controls_Manager::TAB_STYLE
            )
        );

        $this->add_control(
            'space',
            array(
                'label'       => __('Space', 'auxin-hubpost' ),
                'description' => __('Specifies horizontal space between items (pixel).', 'auxin-hubpost' ),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '30',
                'min'         => 0,
                'step'        => 1
            )
        );

        $this->add_control(
            'image_aspect_ratio',
            array(
                'label'       => __('Image aspect ratio', 'auxin-hubpost'),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0.75',
                'options'     => array(
                    '0.75'   => __('Horizontal 4 : 3' , 'auxin-hubpost'),
                    '0.56'   => __('Horizontal 16: 9', 'auxin-hubpost'),
                    '1.00'   => __('Square 1     : 1'     , 'auxin-hubpost'),
                    '1.33'   => __('Vertical 3   : 4'   , 'auxin-hubpost'),
                    'custom' => __('Custom'   , 'auxin-hubpost')
                )
            )
        );

        $this->add_control(
            'image_aspect_ratio_custom',
            array(
                'label'       => __('Custom image aspect ratio', 'auxin-hubpost' ),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => 1,
                'min'         => 0,
                'step'        => 0.5,
                'condition'  => array(
                    'image_aspect_ratio' => 'custom'
                )
            )
        );

        $this->add_control(
            'item_style',
            array(
                'label'       => __('Hover Type','auxin-hubpost' ),
                'description' => __('Move your mouse over each item in order to preview the hover effect.','auxin-hubpost' ),
                'style_items' => 'max-width:48%; min-height:90px;',
                'type'        => 'aux-visual-select',
                'options'     => array(
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
                'default'  => 'classic'
            )
        );

        $this->add_control(
            'img_border_radius',
            array(
                'label'      => __( 'Border Radius', 'auxin-hubpost' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .aux-media-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                )
            )
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'item_hover_style',
                'label' => __( 'Background', 'auxin-hubpost' ),
                'types' => array( 'classic', 'gradient' ),
                'selector' => '{{WRAPPER}} .entry-media::after',
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
                    '{{WRAPPER}}  .entry-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'display_title' => 'yes'
                )
            )
        );

        $this->end_controls_section();

        /*  Read More Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'read_more_style_section',
            array(
                'label'      => __( 'Read More', 'auxin-hubpost' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    "display_read_more" => 'yes'
                ),
            )
        );

        // Read More Text

        $this->start_controls_tabs( 'read_more_colors' );

        $this->start_controls_tab(
            'read_more_color_normal',
            array(
                'label' => __( 'Normal' , 'auxin-hubpost' ),
                'condition' => array(
                    'display_read_more' => 'yes'
                )
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'read-more-background-normal',
                'label' => __( 'Read More Background', 'auxin-hubpost' ),
                'types' => array( 'classic', 'gradient' ),
                'condition'    => array(
                    'display_read_more' => 'yes'
                ),
                'selector' => '{{WRAPPER}} .entry-read-more span',
            )
        );

        $this->add_control(
            'read_more_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .entry-read-more a' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'display_read_more' => 'yes'
                )
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_color_hover',
            array(
                'label' => __( 'Hover' , 'auxin-hubpost' ),
                'condition' => array(
                    'display_read_more' => 'yes'
                )
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'read-more-background-hover',
                'label' => __( 'Read More Background', 'auxin-hubpost' ),
                'types' => array( 'classic', 'gradient' ),
                'condition'    => array(
                    'display_read_more' => 'yes'
                ),
                'selector' => '{{WRAPPER}} .entry-read-more span:hover',
            )
        );

        $this->add_control(
            'read_more_hover_color',
            array(
                'label' => __( 'Color', 'auxin-hubpost' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .entry-read-more a:hover' => 'color:{{VALUE}};',
                ),
                'condition' => array(
                    'display_read_more' => 'yes'
                )
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'read_more_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .entry-read-more a',
                'condition' => array(
                    'display_read_more' => 'yes'
                )
            )
        );

        $this->add_responsive_control(
            'read_more_padding',
            array(
                'label'      => __( 'Padding', 'auxin-hubpost' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .entry-read-more span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'read_more_border',
                'label' => __( 'Read More Border', 'auxin-hubpost' ),
                'selector' => '{{WRAPPER}} .entry-read-more span',
            )
        );

        $this->add_responsive_control(
            'read_more_border_radius',
            array(
                'label'      => __( 'Border Radius', 'auxin-hubpost' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .entry-read-more span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                )
            )
        );

        $this->end_controls_section();

        /*  Categories Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'info_style_section',
            array(
                'label'      => __( 'Categories', 'auxin-hubpost' ),
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


        /*  Wrapper Section
        /*-------------------------------------*/

        $this->start_controls_section(
            'wrapper_style_section',
            array(
                'label'      => __( 'Wrapper', 'auxin-hubpost' ),
                'tab'        => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'wrapper_padding',
            array(
                'label'      => __( 'Padding', 'auxin-hubpost' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .entry-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                )
            )
        );

        $this->add_responsive_control(
            'item_margin_bottom',
            array(
                'label' => __( 'Item Bottom space', 'auxin-hubpost' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 100
                    )
                ),
				'default' => array(
					'unit' => 'px',
					'size' => 30,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .aux-iso-item' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;'
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'entry_box_bg_color',
                'label' => __( 'Entry Box Background', 'auxin-hubpost' ),
                'types' => array( 'classic'),
                'condition'    => array(
                    'item_style' => array('classic', 'classic-lightbox', 'classic-lightbox-boxed'),
                ),
                'selector' => '{{WRAPPER}} .entry-main',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'entry_box_border_color',
                'label' => __( 'Entry Box Border Color', 'auxin-hubpost' ),
                'condition'    => array(
                    'item_style' => array('classic', 'classic-lightbox', 'classic-lightbox-boxed'),
                ),
                'selector' => '{{WRAPPER}} .entry-main',
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

        $display_read_more = $settings['display_read_more'] == 'yes' ? true : false;

        $args = array(
            'cat'                        => $settings['cat'],
            'num'                        => auxin_get_control_size( $settings['num'] ),
            'only_posts__in'             => $settings['only_posts__in'],
            'include'                    => $settings['include'],
            'exclude'                    => $settings['exclude'],
            'offset'                     => auxin_get_control_size( $settings['offset'] ),
            'order_by'                   => $settings['order_by'],
            'order'                      => $settings['order'],
            'exclude_without_media'      => $settings['exclude_without_media'],
            'display_like'               => $settings['display_like'],
            'deeplink'                   => $settings['deeplink'],
            'use_ajax'                   => $settings['use_ajax'],
            'deeplink_slug'              => $settings['deeplink_slug'],
            'show_filters'               => $settings['show_filters'],
            'filter_by'                  => $settings['filter_by'],
            'filter_style'               => $settings['filter_style'],
            'filter_align'               => $settings['filter_align'],
            'reveal_transition_duration' => auxin_get_control_size( $settings['reveal_transition_duration'] ),
            'reveal_between_delay'       => auxin_get_control_size( $settings['reveal_between_delay'] ),
            'hide_transition_duration'   => auxin_get_control_size( $settings['hide_transition_duration'] ),
            'hide_between_delay'         => auxin_get_control_size( $settings['hide_between_delay'] ),

            'item_style'                 => $settings['item_style'],

            'paginate'                   => $settings['paginate'],
            'perpage'                    => $settings['perpage'],
            'display_title'              => $settings['display_title'],
            'show_info'                  => $settings['show_info'],
            'display_read_more'          => $display_read_more,
            'image_aspect_ratio'         => $settings['image_aspect_ratio'] !== 'custom' ? $settings['image_aspect_ratio'] : $settings['image_aspect_ratio_custom'] ,
            'space'                      => auxin_get_control_size( $settings['space'] ),
            'desktop_cnum'               => $settings['columns'],
            'tablet_cnum'                => $settings['columns_tablet'],
            'phone_cnum'                 => $settings['columns_mobile'],

            'layout'                     => 'grid',
            'called_from'                => 'elementor',

            'loadmore_type'              => $settings['loadmore_type'],
            'loadmore_label'             => $settings['loadmore_label'],
        );

        echo auxin_widget_recent_hubposts_grid_callback( $args );
    }

}
