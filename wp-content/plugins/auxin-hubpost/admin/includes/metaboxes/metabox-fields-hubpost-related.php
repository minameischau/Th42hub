<?php
/**
 * Add metabox options for hubpost
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     averta
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2023 averta
*/

function auxhp_metabox_fields_hubpost_related_metadata(){

    $model            = new Auxin_Metabox_Model();
    $model->id        = 'hubpost-related';
    $model->title     = __('Related Hubpost', 'auxin-hubpost');
    $model->css_class = 'aux-hubpost-related-tab';
    $model->fields    = array(

        array(
            'title'       => __('Display Related Hubposts', 'auxin-hubpost'),
            'description' => __( 'Enable it to display related porfolios section on single hubpost page.'),
            'id'          => '_display_related',
            'dependency'  => '',
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'yes'   => __('Yes', 'auxin-hubpost'),
                'no'   =>  __('No', 'auxin-hubpost'),
            )
        ),

        array(
            'title'         => __('Label of Related Section', 'auxin-hubpost'),
            'description'   => __('Specifies the label of related items section.', 'auxin-hubpost'),
            'id'            => '_related_posts_label',
            'dependency'  => array(
                array(
                     'id'      => '_display_related',
                     'value'   => array('default', 'yes'),
                     'operator'=> ''
                )
            ),
            'type'          => 'text',
            'default'       => ''
        ),

        array(
            'title'       => __('Related Items Type', 'auxin-hubpost'),
            'description' => __( 'Specifies the appearance type for related hubpost element.'),
            'id'          => '_related_posts_preview_mode',
            'dependency'  => array(
                array(
                     'id'      => '_display_related',
                     'value'   => array('default', 'yes'),
                     'operator'=> ''
                )
            ),
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'grid'   => __('Grid', 'auxin-hubpost'),
                'carousel'   =>  __('Carousel', 'auxin-hubpost'),
            )
        ),

        array(
            'title'       => __('Number of Columns', 'auxin-hubpost'),
            'description' => '',
            'id'          => '_related_posts_column_number',
            'dependency'  => array(
                array(
                     'id'      => '_display_related',
                     'value'   => array('default', 'yes'),
                     'operator'=> ''
                )
            ),
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                '2'   =>  '2',
                '3'   =>  '3',
                '4'   =>  '4'
            )
        ),

        array(
            'title'       => __('Align Center', 'auxin-hubpost'),
            'description' => __( 'Enable it to make related hubposts section text center.'),
            'id'          => '_related_posts_align_center',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    )
            ),
            'type'        => 'select',
            'default'     => 'default',
            'choices'     => array(
                'default' => __('Theme Default', 'auxin-hubpost'),
                'yes'   => __('Yes', 'auxin-hubpost'),
                'no'   =>  __('No', 'auxin-hubpost'),
            )
        ),

        array(
            'title'       => __('Full Width Related Section', 'auxin-hubpost'),
            'description' => __( 'Enable it to make related hubposts section full width.' ),
            'id'          => '_related_posts_full_width',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    )
            ),
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'yes'   => __('Yes', 'auxin-hubpost'),
                'no'   =>  __('No', 'auxin-hubpost'),
            )
        ),

        array(
            'title'       => __('Snap Related Items', 'auxin-hubpost'),
            'description' => __( 'Enable it to remove space between related hubpost items.' ),
            'id'          => '_related_posts_snap_items',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    )
            ),
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'yes'   => __('Yes', 'auxin-hubpost'),
                'no'   =>  __('No', 'auxin-hubpost'),
            )
        ),

        array(
            'title'       => __('Display Hubpost Categories', 'auxin-hubpost'),
            'description' => __( 'Enable it to display the categories of each hubpost item in related hubposts section.'),
            'id'          => '_related_posts_display_taxonomies',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    )
            ),
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                    'default'   => __('Theme Default', 'auxin-hubpost'),
                    'yes'   => __('Yes', 'auxin-hubpost'),
                    'no'   =>  __('No', 'auxin-hubpost'),
                )
        ),
        
        array(
            'title'       => __('Display The Button Under Related Items', 'auxin-hubpost'),
            'description' => __('You can specific to show the button under related items'),
            'id'          => '_related_posts_all_items_btn_display',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    )
            ),
            'type'          => 'select',
            'default'       => 'default',
            'choices'     => array(
                'default' => __('Theme Default', 'auxin-hubpost'),
                'yes'     => __('Yes', 'auxin-hubpost'),
                'no'      => __('No', 'auxin-hubpost'),
            ),
        ),

        array(
            'title'       => __('Link the Button Under Related Items To', 'auxin-hubpost'),
            'description' => __('Whether to display a button bellow related items section in order to direct visitors to hubpost archive page or not. You can link the button to the hubpost archive page or a custom page, or hide the button.'),
            'id'          => '_related_posts_all_items_url_type',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    ),
                    array(
                        'id'      => '_related_posts_all_items_btn_display',
                        'value'   => array('default', 'yes'),
                        'operator'=> ''
                    )
            ),
            'type'          => 'select',
            'default'       => 'default',
            'choices'     => array(
                'default' => __( 'Theme Default', 'auxin-hubpost'),
                'archive' => __( 'Archive page', 'auxin-hubpost' ),
                'custom'  => __( 'Custom URL', 'auxin-hubpost' ),
            ),
        ),
        
        array(
            'title'       => __('Custom Link for Related Items Button', 'auxin-hubpost'),
            'description' => __('A custom link for the button under related items section.'),
            'id'          => '_related_posts_all_items_url_type_custom',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    ),
                    array(
                        'id'      => '_related_posts_all_items_btn_display',
                        'value'   => array('default', 'yes'),
                        'operator'=> ''
                    ),
                    array(
                        'id'      => '_related_posts_all_items_url_type',
                        'value'   => array('custom'),
                        'operator'=> ''
                    ),
            ),
            'type'          => 'text',
            'default'       => '',
        ),

        array(
            'title'       => __('Custom label for Related Items Button', 'auxin-hubpost'),
            'description' => __('A custom label for the button under related items section.'),
            'id'          => '_related_posts_all_items_btn_label',
            'dependency'  => array(
                    array(
                         'id'      => '_display_related',
                         'value'   => array('default', 'yes'),
                         'operator'=> ''
                    ),
                    array(
                        'id'      => '_related_posts_all_items_btn_display',
                        'value'   => array('default', 'yes'),
                        'operator'=> ''
                    ),
            ),
            'type'          => 'text',
            'default'       => ''
        ),

    );

    return $model;
}
