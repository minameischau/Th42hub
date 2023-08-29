<?php

class Extend_Custom_Field_Hubpost
{
    function __construct()
    {
        // Add metabox
        add_action('add_meta_boxes', [$this, 'custom_hubpost_metabox']);

        // Init custom field
        add_action('init', [$this, 'add_hubpost_custom_fields']);

        // Register custom field in rest
        add_action('rest_api_init', [$this, 'register_custom_fields']);

        // Add bootstrap to admin page 
        add_action('admin_enqueue_scripts', [$this, 'enqueue_bootstrap_admin']);

        // Save
        add_action('save_post', [$this, 'save_hubpost_custom_fields'], 20);
    }

    function save_hubpost_custom_fields($post_id)
    {
        // Check post type
        if (get_post_type($post_id) !== 'hubpost') {
            return;
        }

        // Fields
        $name = sanitize_text_field($_POST['name']);
        $account_name = sanitize_text_field($_POST['account_name']);
        $major = sanitize_text_field($_POST['major']);
        $phone = sanitize_text_field($_POST['phone']);

        // Check validation
        if (empty($name)) {
            // Noti
            wp_die('Please fill in the blank fields. (Name field)');
        }

        // Lưu dữ liệu vào các trường tùy chỉnh
        update_post_meta($post_id, 'name', $name);
        update_post_meta($post_id, 'account_name', $account_name);
        update_post_meta($post_id, 'major', $major);
        update_post_meta($post_id, 'phone', $phone);
    }
    function enqueue_bootstrap_admin()
    {
        global $post_type;

        if ($post_type === 'hubpost') {
            wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css');
            wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
        }
    }

    function custom_hubpost_metabox()
    {
        add_meta_box(
            'custom_hubpost_metabox',
            'Infomation',
            [$this, 'custom_hubpost_metabox_callback'],
            'hubpost',
            'normal',
            'high'
        );
    }

    function custom_hubpost_metabox_callback()
    {
        echo '
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="fw-bold">Name <span class="text-danger">*</span></label>
                <input id="name" class="form-control" name="name" required>
                <span id="error_name" class="text-danger"></span>
            </div>
            <div class="col-md-6">
                <label for="account_name" class="fw-bold">Account name</label>
                <input id="account_name" class="form-control" name="account_name">
            </div>
            <div class="col-md-6">
                <label for="major" class="fw-bold">Major</label>
                <input id="major" class="form-control" name="major">
            </div>
            <div class="col-md-6">
                <label for="phone" class="fw-bold">Phone</label>
                <input id="phone" class="form-control" name="phone">
                <span id="error_phone" class="text-danger"></span>
            </div>
        </div>';
    }

    function get_hubpost_custom_fields($object, $field_name, $request)
    {
        return get_post_meta($object['id'], $field_name, true);
    }

    function register_custom_fields()
    {
        register_rest_field('hubpost', 'name', array(
            'get_callback' => [$this, 'get_hubpost_custom_fields'],
            'schema' => null,
        ));

        register_rest_field('hubpost', 'account_name', array(
            'get_callback' => [$this, 'get_hubpost_custom_fields'],
            'schema' => null,
        ));

        register_rest_field('hubpost', 'major', array(
            'get_callback' => [$this, 'get_hubpost_custom_fields'],
            'schema' => null,
        ));

        register_rest_field('hubpost', 'phone', array(
            'get_callback' => [$this, 'get_hubpost_custom_fields'],
            'schema' => null,
        ));
    }

    function can_user_edit_hubpost($post, $request)
    {
        return current_user_can('edit_post', $post['id']);
    }

    function add_hubpost_custom_fields()
    {
        register_post_meta('hubpost', 'name', array(
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback' => [$this, 'can_user_edit_hubpost']
        ));

        register_post_meta('hubpost', 'account_name', array(
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback' => [$this, 'can_user_edit_hubpost']
        ));

        register_post_meta('hubpost', 'major', array(
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback' => [$this, 'can_user_edit_hubpost']
        ));

        register_post_meta('hubpost', 'phone', array(
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback' => [$this, 'can_user_edit_hubpost']
        ));
    }
}

new Extend_Custom_Field_Hubpost;
