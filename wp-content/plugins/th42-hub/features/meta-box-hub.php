<?php

class MetaBoxHub extends Post_Type_Hub
{
    function __construct()
    {
        add_action('add_meta_boxes', [$this, 'custom_hub_metabox']);
        add_action('save_post', [$this, 'save_custom_hub_metabox'], 20);
    }

    function custom_hub_metabox()
    {
        add_meta_box(
            'custom_hub_metabox',
            'Infomation',
            [$this, 'custom_hub_metabox_callback'],
            'hub',
            'normal',
            'high'
        );
    }

    function custom_hub_metabox_callback()
    {
        require_once(TH42_HUB_PLUGIN_PATH . 'interface/metabox-hub-information-ui.php');
    }

    function save_custom_hub_metabox($post_id)
    {
        if (isset($_POST['name']) && $_POST['name'] != "") {
            update_post_meta($post_id, '_name', $_POST['name']);
        }

        if (isset($_POST['account_name'])) {
            update_post_meta($post_id, '_account_name', $_POST['account_name']);
        }

        if (isset($_POST['major'])) {
            update_post_meta($post_id, '_major', $_POST['major']);
        }

        if (isset($_POST['phone']) && preg_match('/^[0-9]{10}+$/', $_POST['phone'])) {
            update_post_meta($post_id, '_phone', $_POST['phone']);
        }
    }
}

new MetaBoxHub();
