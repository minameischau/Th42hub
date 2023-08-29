<?php
/**
 * Code highlighter element
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     averta
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2023 averta
 */

function auxin_get_recent_hubposts_master_array( $master_array ) {


    $master_array['aux_recent_hubposts_grid'] = array(
        'name'                          => __('Recent Hubpost Grid/Tile/Masonry', 'auxin-hubpost' ),
        'auxin_output_callback'         => 'auxin_widget_recent_hubposts_grid_callback',
        'base'                          => 'aux_recent_hubposts_grid',
        'description'                   => __('It adds recent hubpost items in gird, tile or masonry style.', 'auxin-hubpost' ),
        'class'                         => 'aux-widget-recent-hubposts',
        'show_settings_on_create'       => true,
        'weight'                        => 1,
        'is_widget'                     => false,
        'is_shortcode'                  => true,
        'category'                      => THEME_NAME,
        'group'                         => '',
        'admin_enqueue_js'              => '',
        'admin_enqueue_css'             => '',
        'front_enqueue_js'              => '',
        'front_enqueue_css'             => '',
        'icon'                          => 'aux-element aux-pb-icons-grid',
        'custom_markup'                 => '',
        'js_view'                       => '',
        'html_template'                 => '',
        'deprecated'                    => '',
        'content_element'               => '',
        'as_parent'                     => '',
        'as_child'                      => '',
        'params' => array(
            array(
                'heading'           => __('Title', 'auxin-hubpost' ),
                'description'       => __('Recent items title, leave it empty if you don`t need title.', 'auxin-hubpost'),
                'param_name'        => 'title',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => 'title',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Categories', 'auxin-hubpost'),
                'description'       => __('Specifies a category that you want to show hubpost items from it.', 'auxin-hubpost' ),
                'param_name'        => 'cat',
                'type'              => 'aux_taxonomy',
                'taxonomy'          => 'hubpost-cat',
                'def_value'         => '',
                'holder'            => '',
                'class'             => 'cat',
                'value'             => '', // should use the taxonomy name
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'filter_by',
                    'value'         => array( 'hubpost-cat' )
                ),
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Number of items to show', 'auxin-hubpost'),
                'description'       => __('Leave it empty to show all items', 'auxin-hubpost'),
                'param_name'        => 'num',
                'type'              => 'textfield',
                'value'             => '8',
                'holder'            => '',
                'class'             => 'num',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Exclude hubposts without media','auxin-hubpost' ),
                'description'       => '',
                'param_name'        => 'exclude_without_media',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
             array(
                'heading'            => __('Order by', 'auxin-hubpost'),
                'description'        => '',
                'param_name'         => 'order_by',
                'type'               => 'dropdown',
                'def_value'          => 'date',
                'holder'             => '',
                'class'              => 'order_by',
                'value'              => array (
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
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Order', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'order',
                'type'              => 'dropdown',
                'def_value'         => 'DESC',
                'holder'            => '',
                'class'             => 'order',
                'value'             =>array (
                    'DESC'          => __('Descending', 'auxin-hubpost'),
                    'ASC'           => __('Ascending', 'auxin-hubpost'),
                ),
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Only hubposts','auxin-hubpost' ),
                'description'       => __('If you intend to display ONLY specific hubposts, you should specify them here. You have to insert the post IDs that are separated by comma (eg. 53,34,87,25).', 'auxin-hubpost' ),
                'param_name'        => 'only_posts__in',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Include hubposts','auxin-hubpost' ),
                'description'       => __('If you intend to include additional hubposts, you should specify them here. You have to insert the Post IDs that are separated by comma (eg. 53,34,87,25)', 'auxin-hubpost' ),
                'param_name'        => 'include',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Exclude posts','auxin-hubpost' ),
                'description'       => __('If you intend to exclude specific posts from result, you should specify the posts here. You have to insert the Post IDs that are separated by comma (eg. 53,34,87,25)', 'auxin-hubpost' ),
                'param_name'        => 'exclude',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Start offset','auxin-hubpost' ),
                'description'       => __('Number of hubposts to display or pass over.', 'auxin-hubpost' ),
                'param_name'        => 'offset',
                'type'              => 'textfield',
                'value'             => '',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Query',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Layout', 'auxin-hubpost'),
                'description'       => __('Different layout types of appearing items.', 'auxin-hubpost'),
                'param_name'        => 'layout',
                'type'              => 'aux_visual_select',
                'def_value'         => 'grid',
                'holder'            => '',
                'class'             => 'num',
                'value'             => array(
                    'grid'          => 'Grid',
                    'masonry'       => 'Masonry',
                    'tiles'         => 'Tiles'
                ),
                'choices'           => array (
                    'grid'          => array(
                            'label' => __('Grid', 'auxin-hubpost'),
                            'image' => AUXIN_URL . 'images/visual-select/hubpost-grid.svg'
                    ),
                    'masonry'       => array(
                            'label' => __('Masonry', 'auxin-hubpost'),
                            'image' => AUXIN_URL . 'images/visual-select/hubpost-masonry.svg'
                    ),
                    'tiles'         => array(
                            'label' => __('Tiles', 'auxin-hubpost'),
                            'image' => AUXIN_URL . 'images/visual-select/blog-layout-11.svg'
                    )
                ),
                'admin_label'       => true,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),

            array(
                'heading'          => __( 'Post Tile styles','auxin-hubpost' ),
                'description'      => '',
                'param_name'       => 'tile_style_pattern',
                'type'             => 'aux_visual_select',
                'def_value'        => 'default',
                'holder'           => '',
                'class'            => 'tile_style_pattern',
                'admin_label'      => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'tiles' )
                ),
                'weight'           => '',
                'group'            => '',
                'edit_field_class' => '',
                'choices'          => array(
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
                    ),
                )
            ),

            array(
                'heading'           => __('Image aspect ratio', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'image_aspect_ratio',
                'type'              => 'dropdown',
                'def_value'         => '0.75',
                'holder'            => '',
                'class'             => 'order',
                'value'             => array (
                    '0.75'          => __('Horizontal 4:3' , 'auxin-hubpost'),
                    '0.56'          => __('Horizontal 16:9', 'auxin-hubpost'),
                    '1.00'          => __('Square 1:1'     , 'auxin-hubpost'),
                    '1.33'          => __('Vertical 3:4'   , 'auxin-hubpost')
                ),
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid' )
                ),
                'weight'            => '',
                'group'             => '' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Hubpost hover type','auxin-hubpost' ),
                'description'       => '',
                'param_name'        => 'item_style',
                'type'              => 'aux_visual_select',
                'def_value'         => 'classic',
                'holder'            => '',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'edit_field_class'  => '',
                'choices'             => array(
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
                )
            ),
            array(
                'heading'           => __('Entry Box Background Color', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'entry_background_color',
                'type'              => 'colorpicker',
                'def_value'         => '',
                'value'             => '',
                'holder'            => '',
                'class'             => 'entry_background_color',
                'admin_label'       => true,
                'dependency'        => array(
                    'element' => 'layout',
                    'value'   => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Entry Box Border Color', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'entry_border_color',
                'type'              => 'colorpicker',
                'def_value'         => '',
                'value'             => '',
                'holder'            => '',
                'class'             => 'entry_border_color',
                'admin_label'       => true,
                'dependency'        => array(
                    'element' => 'layout',
                    'value'   => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Hubpost tiles hover type','auxin-hubpost' ),
                'description'       => '',
                'param_name'        => 'tiles_item_style',
                'type'              => 'dropdown',
                'def_value'         => 'overlay',
                'holder'            => '',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'tiles' )
                ),
                'weight'            => '',
                'edit_field_class'  => '',
                'value'             => array(
                    'overlay'                => __('Overlay title style 1', 'auxin-hubpost' ),
                    'overlay-boxed'          =>  __('Overlay title style 2', 'auxin-hubpost' ),
                    'overlay-lightbox'       =>  __('Overlay title with lightbox style 1', 'auxin-hubpost' ),
                    'overlay-lightbox-boxed' =>  __('Overlay title with lightbox style 2', 'auxin-hubpost' ),
                )
            ),

            array(
                'heading'           => __('Show filters','auxin-hubpost' ),
                'description'       => '',
                'param_name'        => 'show_filters',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => 'Filter',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Filter by', 'auxin-hubpost'),
                'description'       => __('Filter by categories or tags', 'auxin-hubpost' ),
                'param_name'        => 'filter_by',
                'type'              => 'dropdown',
                'def_value'         => 'hubpost-filter',
                'holder'            => '',
                'value'             =>array (
                    'hubpost-filter'  => __('Filter', 'auxin-hubpost'),
                    'hubpost-cat'     => __('Category', 'auxin-hubpost'),
                    'hubpost-tag'     => __('Tag', 'auxin-hubpost')
                ),
                'dependency'        => array(
                    'element'       => 'show_filters',
                    'value'         => '1'
                ),
                'weight'            => '',
                'group'             => 'Filter',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Filter Control Alignment', 'auxin-hubpost'),
                'param_name'        => 'filter_align',
                'type'              => 'aux_visual_select',
                'def_value'         => 'aux-left',
                'holder'            => '',
                'choices'           => array(
                    'aux-left'      => array(
                        'label'     => __('Left' , 'auxin-hubpost'),
                        'image'     => AUXIN_URL . 'images/visual-select/filter-left.svg'
                    ),
                    'aux-center'    => array(
                        'label'     => __('Center' , 'auxin-hubpost'),
                        'image'     => AUXIN_URL . 'images/visual-select/filter-mid.svg'
                    ),
                    'aux-right'     => array(
                        'label'     => __('Right' , 'auxin-hubpost'),
                        'image'     => AUXIN_URL . 'images/visual-select/filter-right.svg'
                    )
                ),
                'dependency'        => array(
                    'element'       => 'show_filters',
                    'value'         => '1'
                ),
                'weight'            => '',
                'group'             => 'Filter',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Filter button style', 'auxin-hubpost'),
                'description'       => __('Style of filter buttons.', 'auxin-hubpost' ),
                'param_name'        => 'filter_style',
                'type'              => 'aux_visual_select',
                'def_value'         => 'aux-slideup',
                'holder'            => '',
                'dependency'        => array(
                    'element'       => 'show_filters',
                    'value'         => '1'
                ),
                'weight'            => '',
                'group'             => 'Filter',
                'edit_field_class'  => '',
                'choices'           => array(
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
                    ),
                ),
            ),
            array(
                'heading'           => __('Transition duration on reveal','auxin-hubpost' ),
                'description'       => __('The transition duration while the element is going to be displayed (milliseconds).'),
                'param_name'        => 'reveal_transition_duration',
                'type'              => 'textfield',
                'value'             => '600',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => __('Transitions', 'auxin-hubpost'),
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Delay between reveal','auxin-hubpost' ),
                'description'       => __('The delay between each sequence of revealing transitions (milliseconds).'),
                'param_name'        => 'reveal_between_delay',
                'type'              => 'textfield',
                'value'             => '60',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => __('Transitions', 'auxin-hubpost'),
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Transition duration on hide','auxin-hubpost' ),
                'description'       => __('The transition duration while the element is going to be hidden (milliseconds).'),
                'param_name'        => 'hide_transition_duration',
                'type'              => 'textfield',
                'value'             => '600',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => __('Transitions', 'auxin-hubpost'),
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Delay between hide','auxin-hubpost' ),
                'description'       => __('The delay between each sequence of hiding transitions (milliseconds).'),
                'param_name'        => 'hide_between_delay',
                'type'              => 'textfield',
                'value'             => '30',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => __('Transitions', 'auxin-hubpost'),
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Paginate','auxin-hubpost' ),
                'description'       => __('Paginates the hubpost items', 'auxin-hubpost' ),
                'param_name'        => 'paginate',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => 'Paginate',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Items number perpage', 'auxin-hubpost' ),
                'param_name'        => 'perpage',
                'type'              => 'textfield',
                'value'             => '10',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'paginate',
                    'value'         => '1'
                ),
                'weight'            => '',
                'group'             => 'Paginate',
                'edit_field_class'  => ''
            ),
            array(
                'heading'          => __('Load More Type','auxin-hubpost' ),
                'description'      => '',
                'param_name'       => 'loadmore_type',
                'type'             => 'aux_visual_select',
                'value'            => '',
                'class'            => 'loadmore_type',
                'admin_label'      => false,
                'dependency'       => array(
                    'element'   => 'paginate',
                    'value'     => array( '0' )
                ),
                'weight'           => '',
                'group'            => '' ,
                'edit_field_class' => '',
                'choices'          => array(
                    ''             => array(
                        'label' => __('None', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-none.svg'
                    ),
                    'scroll'       => array(
                        'label' => __('Infinite Scroll', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-infinite.svg'
                    ),
                    'next'         => array(
                        'label' => __('Next Button', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-button.svg'
                    ),
                    'next-prev'    => array(
                        'label' => __('Next Prev', 'auxin-hubpost' ),
                        'image' => AUXIN_URL . 'images/visual-select/load-more-next-prev.svg'
                    )
                )
            ),
            array(
                'heading'           => __('Load More Label', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'loadmore_label',
                'type'              => 'dropdown',
                'def_value'         => 'text',
                'holder'            => '',
                'class'             => 'loadmore_label',
                'value'             => array(
                    'text'       => __('Text', 'auxin-hubpost'),
                    'arrow'      => __('Arrow', 'auxin-hubpost'),
                    'text-arrow' => __('Text & Arrow', 'auxin-hubpost')
                ),
                'admin_label'       => false,
                'dependency'        => array(
                    'element'   => 'paginate',
                    'value'     => array( '0' )
                ),
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Space', 'auxin-hubpost' ),
                'description'       => __('Specifies horizontal space between items (pixel).', 'auxin-hubpost' ),
                'param_name'        => 'space',
                'type'              => 'textfield',
                'value'             => '30',
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Number of columns', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'desktop_cnum',
                'type'              => 'dropdown',
                'def_value'         => '4',
                'holder'            => '',
                'class'             => 'num',
                'value'             => array(
                    '1'  => '1' , '2' => '2'  , '3' => '3' ,
                    '4'  => '4' , '5' => '5'  , '6' => '6'
                ),
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Number of columns in tablet size', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'tablet_cnum',
                'type'              => 'dropdown',
                'def_value'         => 'inherit',
                'holder'            => '',
                'class'             => 'num',
                'value'             => array(
                    'inherit'       => 'Inherited from larger',
                    '1'  => '1', '2' => '2', '3' => '3',
                    '4'  => '4', '5' => '5', '6' => '6'
                ),
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Number of columns in phone size', 'auxin-hubpost'),
                'description'       => '',
                'param_name'        => 'phone_cnum',
                'type'              => 'dropdown',
                'def_value'         => 'inherit',
                'holder'            => '',
                'class'             => 'num',
                'value'             => array(
                    '1' => '1' , '2' => '2', '3' => '3'
                ),
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'layout',
                    'value'         => array( 'grid', 'masonry' )
                ),
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Insert hubpost title','auxin-hubpost' ),
                'description'       => '',
                'param_name'        => 'display_title',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Insert hubpost meta','auxin-hubpost' ),
                'description'       => '',
                'param_name'        => 'show_info',
                'type'              => 'aux_switch',
                'value'             => '1',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Display like button','auxin-hubpost' ),
                'description'       => sprintf(__('Enable it to display %s like button%s on gride template blog. Please note WP Ulike plugin needs to be activaited to use this option.', 'auxin-hubpost'), '<strong>', '</strong>'),
                'param_name'        => 'display_like',
                'type'              => 'aux_switch',
                'value'             => '1',
                'holder'            => '',
                'class'             => 'display_like',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'item_style',
                    'value'         => array( 'classic', 'classic-lightbox', 'classic-lightbox-boxed' )
                ),
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Deeplink', 'auxin-hubpost' ),
                'description'       => __('Enables the deeplink feature, it updates URL based on page and filter status.', 'auxin-hubpost' ),
                'param_name'        => 'deeplink',
                'type'              => 'aux_switch',
                'value'             => '0',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Ajax Compatibility', 'auxin-hubpost' ),
                'description'       => __('Using the Ajax feature Makes the performance better', 'auxin-hubpost' ),
                'param_name'        => 'use_ajax',
                'type'              => 'aux_switch',
                'value'             => '0',
                'class'             => '',
                'admin_label'       => false,
                'weight'            => '',
                'group'             => 'Layout',
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Deeplink slug', 'auxin-hubpost' ),
                'description'       => __('Specifies the deeplink slug value in address bar.', 'auxin-hubpost' ),
                'param_name'        => 'deeplink_slug',
                'type'              => 'textfield',
                'value'             => uniqid('hubpost-'),
                'holder'            => '',
                'class'             => '',
                'admin_label'       => false,
                'dependency'        => array(
                    'element'       => 'deeplink',
                    'value'         => '1'
                ),
                'weight'            => '',
                'group'             => 'Layout' ,
                'edit_field_class'  => ''
            ),
            array(
                'heading'           => __('Extra class name','auxin-hubpost' ),
                'description'       => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'auxin-hubpost' ),
                'param_name'        => 'extra_classes',
                'type'              => 'textfield',
                'value'             => '',
                'def_value'         => '',
                'holder'            => '',
                'class'             => 'extra_classes',
                'admin_label'       => false,
                'dependency'        => '',
                'weight'            => '',
                'group'             => '',
                'edit_field_class'  => ''
            )
        )
    );

    return $master_array;
}

add_filter( 'auxin_master_array_shortcodes', 'auxin_get_recent_hubposts_master_array', 10, 1 );


/**
 * Element without loop and column
 * The front-end output of this element is returned by the following function
 *
 * @param  array  $atts              The array containing the parsed values from shortcode, it should be same as defined params above.
 * @param  string $shortcode_content The shorcode content
 * @return string                    The output of element markup
 */
function auxin_widget_recent_hubposts_grid_callback( $atts, $shortcode_content = null ){

    // Defining default attributes
    $default_atts = array(
        'title'                      => '', // header title
        'cat'                        => '',
        'num'                        => '8', // max generated entry
        'only_posts__in'             => '', // display only these post IDs. array or string comma separated
        'include'                    => '', // include these post IDs in result too. array or string comma separated
        'exclude'                    => '', // exclude these post IDs from result. array or string comma separated
        'posts_per_page'             => -1,
        'offset'                     => '',
        'order_by'                   => 'date',
        'order'                      => 'DESC',
        'exclude_without_media'      => 0,
        'display_like'               => 1,
        'deeplink'                   => 0,
        'use_ajax'                   => 0,
        'deeplink_slug'              => uniqid('hubpost-'),
        'show_filters'               => 1,
        'filter_by'                  => 'hubpost-filter',
        'filter_style'               => 'aux-slideup',
        'filter_align'               => 'aux-left',
        'reveal_transition_duration' => '600',
        'reveal_between_delay'       => '60',
        'hide_transition_duration'   => '600',
        'hide_between_delay'         => '30',
        'item_style'                 => 'classic',
        'tile_style_pattern'         => 'default',
        'tiles_item_style'           => 'overlay',
        'entry_background_color'     => '',
        'entry_border_color'         => '',
        'paginate'                   => 1,
        'perpage'                    => 10,
        'crop'                       => true,
        // 'preloadable'                => false,
        // 'preload_preview'            => true,
        // 'preload_bgcolor'            => '',
        'display_title'              => true,
        'show_info'                  => 1,
        'display_read_more'          => false,
        'image_aspect_ratio'         => 0.75,
        'space'                      => 30,
        'desktop_cnum'               => 4,
        'tablet_cnum'                => 'inherit',
        'phone_cnum'                 => '1',
        'layout'                     => 'grid',
        'tag'                        => '',
        'filter'                     => '',
        'extra_classes'              => '',
        'extra_column_classes'       => '',
        'custom_el_id'               => '',
        'template_part_file'         => 'recent-hubpost',
        'extra_template_path'        =>  AUXHP_PUB_DIR . '/templates/elements',
        'universal_id'               => '',
        'query_args'                 => array(),
        'term'                       => '',
        'reset_query'                => true,
        'use_wp_query'               => false, // true to use the global wp_query, false to use internal custom query
        'wp_query_args'              => array(), // additional wp_query args
        'custom_wp_query'            => '',
        'loadmore_type'              => '', // 'next' (more button), 'scroll', 'next-prev'
        'loadmore_label'             => 'text',
        'loadmore_per_page'          => '',
        'term_field'                 => 'slug',
        'base'                       => 'aux_recent_hubposts_grid',
        'base_class'                 => 'aux-widget-recent-hubposts',
        'paged'                      => '',
        'override_global_query'      => false
    );

    $result = auxin_get_widget_scafold( $atts, $default_atts, $shortcode_content );
    extract( $result['parsed_atts'] );

    $filter_extraclass = '';
    $filter_extraclass .= auxin_is_true( $use_ajax ) ? 'aux-ajax-filters' : 'aux-isotope-filters';

    ob_start();

    // widget header ------------------------------
    echo $result['widget_header'];
    echo $result['widget_title'];

    $filter_args = array(
        'taxonomy'   => $filter_by,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'meta_key' => 'tax_position'
            )
        ),
        'orderby'    => 'tax_position',
        'hide_empty' => true,
    );

    $filter_args['include'] = 'hubpost-cat' === $filter_by ? $cat : '';


    if ( function_exists('auxin_filter_output') && auxin_is_true ( $show_filters ) && ! $skip_wrappers ) {

        // Filter Markup
        auxin_filter_output(
            $filter_args,
            $filter_style,
            $filter_align,
            $filter_extraclass
        );

    }

    include_once auxin_get_template_file( $template_part_file, '', $extra_template_path );
    echo auxin_recent_hubpost( $result['parsed_atts'] );
    echo '<script type="text/javascript">var ' . $universal_id . 'AjaxConfig = ' . wp_json_encode( $result['parsed_atts'] ) . ';</script>';

    // widget footer ------------------------------
    echo $result['widget_footer'];

    return ob_get_clean();
}
