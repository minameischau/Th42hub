<?php

class Custom_Image_Size_Single_Portfolio
{
    public function __construct()
    {
        add_filter('auxin_defined_option_fields_sections', [$this, 'auxin_define_portfolio_theme_options'], 13, 1);
    }

    function auxin_define_portfolio_theme_options($fields_sections_list)
    {

        $options  = $fields_sections_list['fields'];
        $sections = $fields_sections_list['sections'];

        foreach ($options as $k => $option) {
            if ($option['id'] == 'portfolio_single_image_size') {
                $options[$k]['choices']['214x214'] = '214x214';
                break;
            }
        }
        return array('fields' => $options, 'sections' => $sections);
    }
}
