<?php
/**
 * Template Loader
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


class Auxhp_Template_Loader {

    public static function init() {
        add_filter( 'template_include' , array( __CLASS__, 'template_loader' ) );
    }

    /**
     * Load a template.
     *
     * @param mixed $template
     * @return string
     */
    public static function template_loader( $template ) {
        $find = array();
        $file = '';

        if ( is_embed() ) {
            return $template;
        }


        if ( is_single() && get_post_type() == 'hubpost' ) {

            $find[] = AUXHP()->template_path() . 'single-hubpost.php';

        } elseif ( is_tax( get_object_taxonomies( 'hubpost' ) ) ) {

            $term   = get_queried_object();

            if ( is_tax( 'hubpost-cat' ) || is_tax( 'hubpost-tag' ) ) {
                $file = 'taxonomy-' . $term->taxonomy . '.php';
            } elseif ( !is_search() ) {
                $file = 'archive-hubpost.php';
            }

            $find[] = AUXHP()->template_path() . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
            $find[] = AUXHP()->template_path() . 'taxonomy-' . $term->taxonomy . '.php';
            $find[] = AUXHP()->template_path() . $file;

        } elseif ( is_post_type_archive( 'hubpost' ) && !is_search() ) {

            $find[] = AUXHP()->template_path() . 'archive-hubpost.php';
        }

        $find      = array_unique( $find );

        if ( $find && $templates = locate_template( array_unique( $find ) ) ) {
            return $templates;
        }

        foreach ( $find as $file ) {
            if( file_exists( $file ) ){
                $template = $file;
                break;
            }
        }

        return $template;
    }

}

Auxhp_Template_Loader::init();
