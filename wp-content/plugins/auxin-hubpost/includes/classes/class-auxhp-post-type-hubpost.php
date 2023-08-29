<?php
/**
 * Add Hubpost post type and taxonomies
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     averta
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2023 averta
*/

// no direct access allowed
if ( ! defined('ABSPATH') )  exit;



/**
 * Register Hubpost post type and taxonomies
 *
 */
class Auxhp_Post_Type_Hubpost extends Auxin_Post_Type_Base {



    function __construct() {

        $post_type = 'hubpost';

        //add_filter( 'admin_post_thumbnail_html' , array( $this, 'featured_image_instruction' ) );
        //add_filter( 'the_permalink'             , array( $this, 'posttype_permalink' ), 10, 1 );

        parent::__construct( $post_type );
    }


    /**
     * Register post type
     *
     * @return void
     */
    public function register_post_type() {

        if( ! $single_slug  = get_theme_mod( $this->prefix.'permalink_'.$this->post_type.'_structure', '' ) )
            $single_slug    = $this->post_type; // validate single slug

        if( ! $archive_slug = get_theme_mod( $this->prefix.'permalink_'.$this->post_type.'_archive_structure', '' ) )
            $archive_slug   = $this->post_type.'/all'; // validate archive slug


        $labels = array(
            'name'               => _x( 'Hubposts'          , 'auxin-hubpost' ),
            'singular_name'      => __( 'Hubpost'           , 'auxin-hubpost' ),
            'menu_name'          => _x( 'Hubposts'          , 'Admin menu name', 'auxin-hubpost' ),
            'add_new'            => __( 'Add New'             , 'auxin-hubpost' ),
            'all_items'          => __( 'All Hubposts'      , 'auxin-hubpost' ),
            'add_new_item'       => __( 'Add New Hubpost'   , 'auxin-hubpost' ),
            'edit_item'          => __( 'Edit Hubpost'      , 'auxin-hubpost' ),
            'new_item'           => __( 'New Hubpost'       , 'auxin-hubpost' ),
            'view_item'          => __( 'View Hubpost'      , 'auxin-hubpost' ),
            'search_items'       => __( 'Search Hubposts'   , 'auxin-hubpost' ),
            'parent'             => __( 'Parent Hubpost'    , 'auxin-hubpost' ),
            'not_found'          => __( 'No Hubposts found' , 'auxin-hubpost' ),
            'not_found_in_trash' => __( 'No Hubposts found in Trash', 'auxin-hubpost' )
        );

        $args = array(
            'labels'                => $labels,
            'description'           => __( 'Here you can add new hubpost to your website.', 'auxin-hubpost' ),
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite'               => array (
                'slug'       => $single_slug,
                'with_front' => true,
                'feeds'      => true
            ),
            'capability_type'       => $this->post_type,
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'menu_position'         => 30,
            'show_in_nav_menus'     => true,
            'menu_icon'             => 'dashicons-art',
            'supports'              => array( 'title','editor','thumbnail','excerpt','page-attributes', 'revisions', 'custom-fields' ),
            'has_archive'           => $archive_slug,
            'show_in_rest'          => true
        );

        return register_post_type( $this->post_type, apply_filters( "auxin_register_post_type_args_{$this->post_type}", $args ) );
    }

    /**
     * Register taxonomies
     *
     * @return void
     */
    public function register_taxonomies() {

        // labels for Category of this post type
        $cat_labels = array(
            'name'              => __( 'Hubpost Categories'        , 'auxin-hubpost' ),
            'singular_name'     => __( 'Hubpost Category'        , 'auxin-hubpost' ),
            'all_items'         => __( 'All Hubpost Categories'  , 'auxin-hubpost' ),
            'parent_item'       => __( 'Parent Hubpost Category' , 'auxin-hubpost' ),
            'parent_item_colon' => __( 'Parent Hubpost Category:', 'auxin-hubpost' ),
            'edit_item'         => __( 'Edit Hubpost Category'   , 'auxin-hubpost' ),
            'update_item'       => __( 'Update Hubpost Category' , 'auxin-hubpost' ),
            'add_new_item'      => __( 'Add New Hubpost Category', 'auxin-hubpost' ),
            'new_item_name'     => __( 'New Hubpost Category'    , 'auxin-hubpost' ),
            'search_items'      => __( 'Search in Hubpost Categories', 'auxin-hubpost' ),
            'menu_name'         => _x( 'Categories', 'hubpost-cat admin menu name', 'auxin-hubpost' )
        );

        $tax_cat_name = 'hubpost-cat';

        register_taxonomy( $tax_cat_name,
            apply_filters( "auxin_taxonomy_post_types_for_{$tax_cat_name}" , array( $this->post_type ) ),
            apply_filters( "auxin_taxonomy_args_{$tax_cat_name}"       , array(
                'hierarchical'          => true,
                'tax_position'          => true,
                'label'                 => __( 'Hubpost Categories', 'auxin-hubpost' ),
                'labels'                => $cat_labels,
                'show_ui'               => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'capabilities'          => array(
                    'manage_terms'      => "manage_{$this->post_type}_terms",
                    'edit_terms'        => "edit_{$this->post_type}_terms",
                    'delete_terms'      => "delete_{$this->post_type}_terms",
                    'assign_terms'      => "assign_{$this->post_type}_terms",
                ),
                'rewrite'       => array(
                    'slug'          => get_theme_mod( $this->prefix.'permalink_'. $this->post_type. '_' .str_replace('-', '_', $tax_cat_name ) .'_structure', $tax_cat_name ),
                    'hierarchical'  => false
                ),
                'show_in_rest'          => true
            ) )
        );





        // labels for Tag of this post type
        $tag_labels = array(
            'name'                       => __( 'Hubpost Tags'                   , 'auxin-hubpost' ),
            'singular_name'              => __( 'Hubpost Tag'                    , 'auxin-hubpost' ),
            'search_items'               => __( 'Search in Hubpost Tags'         , 'auxin-hubpost' ),
            'popular_items'              => __( 'Popular Tags'                     , 'auxin-hubpost' ),
            'all_items'                  => __( 'All Hubpost Tags'               , 'auxin-hubpost' ),
            'parent_item'                => __( 'Parent Hubpost Tag'             , 'auxin-hubpost' ),
            'parent_item_colon'          => __( 'Parent Hubpost Tag:'            , 'auxin-hubpost' ),
            'edit_item'                  => __( 'Edit Hubpost Tag'               , 'auxin-hubpost' ),
            'update_item'                => __( 'Update Hubpost Tag'             , 'auxin-hubpost' ),
            'add_new_item'               => __( 'Add new Hubpost Tag'            , 'auxin-hubpost' ),
            'new_item_name'              => __( 'New Hubpost Tag'                , 'auxin-hubpost' ),

            'separate_items_with_commas' => __( 'Separate tags with commas'        , 'auxin-hubpost' ),
            'add_or_remove_items'        => __( 'Add or remove Tag'                , 'auxin-hubpost' ),
            'choose_from_most_used'      => __( 'Choose from the most used tags'   , 'auxin-hubpost' ),
            'menu_name'                  => _x( 'Tags', 'hubpost-tag admin menu name'  , 'auxin-hubpost' )
        );

        $tax_tag_name = 'hubpost-tag';

        register_taxonomy( $tax_tag_name,
            apply_filters( "auxin_taxonomy_post_types_for_{$tax_tag_name}" , array( $this->post_type ) ),
            apply_filters( "auxin_taxonomy_args_{$tax_tag_name}"       , array(
                'hierarchical'          => false,
                'label'                 => __( 'Hubpost Tags', 'auxin-hubpost' ),
                'labels'                => $tag_labels,
                'show_ui'               => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'capabilities'          => array(
                    'manage_terms'      => "manage_{$this->post_type}_terms",
                    'edit_terms'        => "edit_{$this->post_type}_terms",
                    'delete_terms'      => "delete_{$this->post_type}_terms",
                    'assign_terms'      => "assign_{$this->post_type}_terms",
                ),
                'rewrite'       => array(
                    'slug'          => get_theme_mod( $this->prefix.'permalink_'. $this->post_type. '_' .str_replace('-', '_', $tax_tag_name ).'_structure', $tax_tag_name ),
                    'hierarchical'  => false
                ),
                'show_in_rest'          => true
            ) )
        );





        // labels for filter of this post type
        $tag_labels = array(
            'name'                       => __( 'Hubpost Filters'                , 'auxin-hubpost' ),
            'singular_name'              => __( 'Hubpost Filter'                 , 'auxin-hubpost' ),
            'search_items'               => __( 'Search in Hubpost Filters'      , 'auxin-hubpost' ),
            'popular_items'              => __( 'Popular Filters'                  , 'auxin-hubpost' ),
            'all_items'                  => __( 'All Hubpost Filters'            , 'auxin-hubpost' ),
            'parent_item'                => __( 'Parent Hubpost Filter'          , 'auxin-hubpost' ),
            'parent_item_colon'          => __( 'Parent Hubpost Filter:'         , 'auxin-hubpost' ),
            'edit_item'                  => __( 'Edit Hubpost Filter'            , 'auxin-hubpost' ),
            'update_item'                => __( 'Update Hubpost Filter'          , 'auxin-hubpost' ),
            'add_new_item'               => __( 'Add new Hubpost Filter'         , 'auxin-hubpost' ),
            'new_item_name'              => __( 'New Hubpost Filter'             , 'auxin-hubpost' ),

            'separate_items_with_commas' => __( 'Separate filters with commas'     , 'auxin-hubpost' ),
            'add_or_remove_items'        => __( 'Add or remove filter'             , 'auxin-hubpost' ),
            'choose_from_most_used'      => __( 'Choose from the most used filters', 'auxin-hubpost' ),
            'menu_name'                  => _x( 'Filters', 'hubpost-filter admin menu name'  , 'auxin-hubpost' )
        );

        $tax_tag_name = 'hubpost-filter';

        register_taxonomy( $tax_tag_name,
            apply_filters( "auxin_taxonomy_post_types_for_{$tax_tag_name}" , array( $this->post_type ) ),
            apply_filters( "auxin_taxonomy_args_{$tax_tag_name}"       , array(
                'hierarchical'          => false,
                'label'                 => __( 'Hubpost Filters', 'auxin-hubpost' ),
                'labels'                => $tag_labels,
                'show_ui'               => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'capabilities'          => array(
                    'manage_terms'      => "manage_{$this->post_type}_terms",
                    'edit_terms'        => "edit_{$this->post_type}_terms",
                    'delete_terms'      => "delete_{$this->post_type}_terms",
                    'assign_terms'      => "assign_{$this->post_type}_terms",
                ),
                'rewrite'  => false,
                'show_in_rest'          => true
            ) )
        );

    }


    /**
     * Customizing post type list Columns
     *
     * @param  array $column  An array of column name => label
     * @return array          List of columns shown when listing posts of the post type
     */
    public function manage_edit_columns( $columns ){
        unset( $columns['title'], $columns['date'] );

        $new_columns = array(
            "cb"                => "<input type=\"checkbox\" />",
            "hubpost_image"   => _x( 'Image'              , 'Image column at hubpost edit columns', 'auxin-hubpost' ),
            "title"             => _x( 'Title'              , 'Title column at hubpost edit columns', 'auxin-hubpost' ),
            "cat"               => _x( 'Category / Type'    , 'Type  column at hubpost edit columns', 'auxin-hubpost' ),
            "tag"               => _x( 'Tag / Filter'       , 'Tag/Filter column at hubpost edit columns', 'auxin-hubpost' ),
            "release_date"      => _x( 'Release Date'       , 'Date  column at hubpost edit columns', 'auxin-hubpost' )
        );

        return array_merge( $new_columns, $columns );
    }


    /**
     * Applied to the list of columns to print on the manage posts screen for current post type
     *
     * @param  array $column  An array of column name => label
     * @return array          List of columns shown when listing posts of the post type
     */
    public function manage_posttype_custom_columns( $column ){
        global $post;

        switch ( $column ) {
            case "description":
                the_excerpt();
                break;
            case "cat":
                echo get_the_term_list( $post->ID, 'hubpost-cat', '', ', ','' );
                break;
            case "tag":
                echo get_the_term_list( $post->ID, 'hubpost-tag', '', ', ','' );
                break;
            case "hubpost_image":
                echo get_the_post_thumbnail( $post, 'thumbnail' );
                break;
            case "release_date":
                echo get_post_meta( $post->ID, "release-date", true );
                break;
        }
    }


    /**
     * Add instruction to featured post
     */
    function featured_image_instruction( $content ) {
        if( $this->post_type == get_post_type() ){
            return $content .= sprintf('<p>%s</p>', __( 'This is an image that is chosen as the representative/cover image for your project.', 'auxin-hubpost' ) );
        }
        return $content;
    }


    /**
     * Redirect post type single page if redirect URL is set
     */
    function posttype_permalink( $permalink ){
        global $post;

        if ( isset( $post ) && $this->post_type == get_post_type( $post->ID ) ){
            $redirect_url = get_post_meta( $post->ID, "{$this->post_type}-redirect-url", true );
            if( ! empty( $redirect_url ) )
                  return $redirect_url;
        }
        return $permalink;
    }

}
