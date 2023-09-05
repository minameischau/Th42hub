<?php

class Custom_Field_Portfolio
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
            if ($option['id'] == 'portfolio_metadata_list_1') {
                $options[$k]['choices']['custom_meta_name'] = 'Name';
                $options[$k]['choices']['custom_meta_major'] = 'Major';
                $options[$k]['choices']['custom_meta_phone'] = 'Phone';
                $options[$k]['choices']['custom_meta_website'] = 'Website';

                $options[$k]['default'] = '[{"id":"custom_meta_name", "label":"Name", "value":"Name"},{"id":"custom_meta_major", "label":"Major", "value":"Major"},{"id":"custom_meta_phone", "label":"Phone", "value":"Phone"},{"id":"custom_meta_website", "label":"Website", "value":"Website"}]';
                echo_print_r($options[$k]);

                break;
            }
        }
        return array('fields' => $options, 'sections' => $sections);
    }
}
