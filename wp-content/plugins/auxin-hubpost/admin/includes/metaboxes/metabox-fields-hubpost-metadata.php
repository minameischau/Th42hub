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

function auxhp_metabox_fields_hubpost_metadata(){

    $model            = new Auxin_Metabox_Model();
    $model->id        = 'hubpost-metadata';
    $model->title     = __('Hubpost Information', 'auxin-hubpost');
    $model->css_class = 'aux-hubpost-metadata-tab';
    $model->fields    = array(

        // array(
        //     'title'         => __('Featured Image', 'auxin-hubpost' ),
        //     'description'   => __('Specifies the main cover image for this hubpost.'),
        //     'id'            => '_thumbnail_id',
        //     'type'          => 'image',
        //     'default'       => ''
        // ),
        array(
            'title'         => __('Featured Image (Secondary)', 'auxin-hubpost' ),
            'description'   => __('Specifies the secondary cover image for this hubpost.'),
            'id'            => '_thumbnail_id2',
            'type'          => 'image',
            'default'       => ''
        ),
        array(
            'title'         => __('Hide featured image.', 'auxin-hubpost'),
            'description'   => __('Enable this option to remove the featured image from single page of this hubpost. Useful when you intent to display images that vary from the featured image.', 'auxin-hubpost'),
            'id'            => '_no_feature_image_in_single',
            'type'          => 'switch',
            'default'       => '0'
        ),

        array(
            'title'         => __('Overview', 'auxin-hubpost'),
            'description'   => __('Specifies a short description about the project.', 'auxin-hubpost'),
            'id'            => '_overview',
            'type'          => 'editor',
            'default'       => ''
        ),

        array(
            'title'         => __('Overview Title', 'auxin-hubpost'),
            'description'   => __('Specifies an optional title for project overview.', 'auxin-hubpost'),
            'id'            => '_overview_title',
            'type'          => 'text',
            'default'       => ''
        ),

        array(
            'title'         => __('Overview Alignment', 'auxin-hubpost'),
            'description'   => __('Specifies alignment for the project overview and corresponding information.', 'auxin-hubpost'),
            'id'            => '_overview_info_alignment',
            'type'          => 'radio-image',
            'default'       => 'default',
            'choices'       => array(
                'default' => array(
                    'label'     => __('Default', 'auxin-hubpost'),
                    'css_class' => 'axiAdminIcon-default',
                ),
                'left' => array(
                    'label'     => __('Left', 'auxin-hubpost'),
                    'css_class' => 'axiAdminIcon-text-align-left'
                ),
                'center' => array(
                    'label'     => __('Center', 'auxin-hubpost'),
                    'css_class' => 'axiAdminIcon-text-align-center'
                )
            )
        ),

        array(
            'title'         => __('Info Layout', 'auxin-hubpost'),
            'description'   => __('Specifies the alignment of metadata column. (Default: "right" for LTR websites and "left" for RTL ones)', 'auxin-hubpost'),
            'id'            => '_side_info_pos',
            'id_deprecated' => 'page_layout',
            'type'          => 'radio-image',
            'default'       => 'default',
            'choices'       => array(
                'default'   => array(
                    'label' => __('Default', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/default4.svg'
                ),
                'right'   => array(
                    'label' => __('Info on Right', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/hubpost-single-classic.svg'
                ),
                'left'   => array(
                    'label' => __('Info on Left', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/hubpost-single-classic-left-algin.svg'
                ),
                'top'   => array(
                    'label' => __('Info on Top', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/hubpost-single-info-on-top.svg'
                ),
                'top-reverse'   => array(
                    'label' => __('Info on Top - Direction reverse', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/hubpost-single-info-on-top-direction-reverse.svg'
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
            )
        ),

        array(
            'title'         => __('Sticky Side Area', 'auxin-hubpost'),
            'description'   => __('Enable it to stick the side area on page while scrolling.', 'auxin-hubpost'),
            'id'            => '_sticky_sidebar',
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'yes'   => __('Yes', 'auxin-hubpost'),
                'no'   =>  __('No', 'auxin-hubpost'),
            ),
            'dependency'    => array(
                array(
                    'id' => '_side_info_pos',
                    'value' => array( 'right', 'left' )
                )
            ),
        ),

        array(
            'title'   => __('Info Box Background Color', 'auxin-hubpost'),
            'description'   => __('Specifies the color of info box.', 'auxin-hubpost'),
            'id'            => '_side_info_color',
            'type'          => 'color',
            'dependency'    => array(
                array(
                    'id' => '_side_info_pos',
                    'value' => array( 'right', 'left' )
                )
            )
        ),

        array(
            'title'   => __('Info Box Font Color', 'auxin-hubpost'),
            'description'   => __('Specifies the color of font at info box.', 'auxin-hubpost'),
            'id'            => '_side_info_font_color',
            'type'          => 'select',
            'default'       => 'dark',
            'dependency'    => array(
                array(
                    'id' => '_side_info_pos',
                    'value' => array( 'right', 'left' )
                )
            ),
            'choices'       => array(
                ''          => __( 'Select Info Box Style', 'auxin-hubpost' ),
                'dark'      => __( 'Dark', 'auxin-hubpost' ),
                'light'     => __( 'Light', 'auxin-hubpost' )
            )
        ),
        // @TODO: we should add this in future
        // array(
        //     'title'       => __('Content Style', 'auxin-hubpost'),
        //     'description' => __('You can reduce the width of text lines and increase the readability of context in single hubpost of hubpost (does not affect the width of media).', 'auxin-hubpost'),
        //     'id'          => 'hubpost_single_content_style',
        //     'section'     => 'hubpost-setting-section-single',
        //     'dependency'  => array(),
        //     'choices'     => array(
        //         'default'   => array(
        //             'label' => __('Default', 'auxin-hubpost'),
        //             'image' => AUXIN_URL . 'images/visual-select/default4.svg'
        //         ),
        //         'simple'  => array(
        //             'label'  => __( 'Normal' , 'auxin-hubpost'),
        //             'image' => AUXIN_URL . 'images/visual-select/content-normal.svg'
        //         ),
        //         'narrow' => array(
        //             'label'  => __( 'Narrow Content' , 'auxin-hubpost'),
        //             'image' => AUXIN_URL . 'images/visual-select/content-less.svg'
        //         )
        //     ),
        //     'transport' => 'postMessage',
        //     'post_js'   => '$(".single-hubpost .aux-primary .hentry").toggleClass( "aux-narrow-context", "narrow" == to );',
        //     'default'   => 'simple',
        //     'type'      => 'radio-image'
        // ),

        array(
            'title'       => __( 'Display Next & Previous hubposts', 'auxin-hubpost' ),
            'description' => __( 'Enable it to display links to next and previous hubposts on single hubpost page.' ),
            'id'          => '_show_next_prev_nav',
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
            'title'       => __('Skin for Next & Previous Links', 'auxin-hubpost'),
            'description' => __('Specifies the skin for next and previous navigation block.', 'auxin-hubpost'),
            'id'          => '_next_prev_nav_skin',
            'dependency'  => array(
                array(
                     'id'      => '_show_next_prev_nav',
                     'value'   => array('default', 'yes'),
                     'operator'=> ''
                )
            ),
            'choices'     => array(
                'default'   => array(
                    'label' => __('Default', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/default4.svg'
                ),
                'classic-title'    => array(
                    'label' => __('Classic Project Navigation', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-6.svg'
                ),
                'classic'    => array(
                    'label' => __('Classic Project Navigation Without Title', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-6.svg'
                ),
                'minimal' => array(
                    'label'     => __('Minimal (default)', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-1.svg'
                ),
                'thumb-arrow' => array(
                    'label'     => __('Thumbnail with Arrow', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-2.svg'
                ),
                'thumb-no-arrow' => array(
                    'label'     => __('Thumbnail without Arrow', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-3.svg'
                ),
                'boxed-image' => array(
                    'label'     => __('Navigation with Light Background', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-4.svg'
                ),
                'boxed-image-dark' => array(
                    'label'     => __('Navigation with Dark Background', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-5.svg'
                ),
                'thumb-arrow-sticky' => array(
                    'label'     => __('Sticky Thumbnail with Arrow', 'auxin-hubpost'),
                    'image' => AUXIN_URL . 'images/visual-select/post-navigation-6.svg'
                ),
                'modern'    => array(
                    'label'             => __('Modern', 'auxin-hubpost'),
                    'image'             => AUXIN_URL . 'images/visual-select/post-navigation-2.svg'
                ),
            ),
            'type'          => 'radio-image',
            'default'       => 'default'
        ),
        
        array(
            'title'         => __('Next & Previous Button Link', 'auxin-hubpost'),
            'description'   => __('Specifies the link of button in next and previous navigation. leave it blank to use default hubpost archive link', 'auxin-hubpost'),
            'id'            => '_next_prev_nav_btn_link',
            'dependency'  => array(
                array(
                    'id'      => '_show_next_prev_nav',
                    'value'   => array('default', 'yes'),
                    'operator'=> ''
                ),
                array(
                    'id'      => '_next_prev_nav_skin',
                    'value'   => array('modern', 'classic', 'classic-title'),
                    'operator'=> ''
               )
            ),
            'type'          => 'text',
            'default'       => '',
        ),

        array(
            'title'         => __('Display Hubpost Meta Info', 'auxin-hubpost'),
            'description'   => __('Enable this option to display extra inormation about this hubpost.', 'auxin-hubpost'),
            'id'            => '_show_side_info_meta',
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'yes'       => __('Yes', 'auxin-hubpost'),
                'no'        => __('No', 'auxin-hubpost'),
            )
        ),

        array(
            'title'         => __('Display Single Hubpost Categories', 'auxin-hubpost'),
            'description'   => __('Specifies whether to display catetory section or not.', 'auxin-hubpost'),
            'id'            => '_side_info_dicplay_cat',
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'yes'       => __('Yes', 'auxin-hubpost'),
                'no'        => __('No', 'auxin-hubpost'),
            ),
            'dependency'  => array(
                array(
                     'id'      => '_show_side_info_meta',
                     'value'   => array('yes', 'default'),
                     'operator'=> '=='
                )
            )
        ),

        array(
            'title'         => __('Display Single Hubpost Tags', 'auxin-hubpost'),
            'description'   => __('Specifies whether to display tag section or not.', 'auxin-hubpost'),
            'id'            => '_side_info_dicplay_tag',
            'type'          => 'select',
            'default'       => 'default',
            'choices'       => array(
                'default'   => __('Theme Default', 'auxin-hubpost'),
                'yes'   => __('Yes', 'auxin-hubpost'),
                'no'   =>  __('No' , 'auxin-hubpost'),
            ),
            'dependency'  => array(
                array(
                     'id'      => '_show_side_info_meta',
                     'value'   => array('yes', 'default'),
                     'operator'=> '=='
                )
            )
        ),

        array(
            'title'         => __('URL for Launch Button', 'auxin-hubpost'),
            'description'   => __('Specifies an URL for action button in order to lunch the project\'s webpage. Leave it empty if you don`t need Lunch Project Button.', 'auxin-hubpost'),
            'id'            => '_lunch_button_url',
            'type'          => 'text',
            'default'       => '',
            'dependency'  => array(
                array(
                     'id'      => '_show_side_info_meta',
                     'value'   => array('yes', 'default'),
                     'operator'=> '=='
                )
            )
        )

    );

    // Generate the custom metadata fields base on defined fields in theme options
    $metafields = json_decode( auxin_get_option( 'hubpost_metadata_list_1' ), true );
    if( is_array( $metafields ) ){
        foreach ( $metafields as $metadata_info ) {
            if( ! empty( $metadata_info['id'] ) ){
                $model->fields[] = array(
                    'title'         => $metadata_info['value'],
                    'description'   => '',
                    'id'            => '_auxin_meta_' . $metadata_info['id'],
                    'type'          => 'text',
                    'default'       => '',
                    'dependency'  => array(
                        array(
                             'id'      => '_show_side_info_meta',
                             'value'   => array('yes', 'default'),
                             'operator'=> '=='
                        )
                    )
                );
            }
        }
    }

    return $model;
}
