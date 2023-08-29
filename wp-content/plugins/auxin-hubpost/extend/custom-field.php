<?php

class Extend_Custom_Field_Hubpost
{
    function __construct()
    {
        // Add metabox
        add_action('add_meta_boxes', [$this, 'custom_hubpost_metabox']);

        // Add bootstrap to admin page 
        add_action('admin_enqueue_scripts', [$this, 'enqueue_bootstrap_admin']);

        // Save
        add_action('save_post', [$this, 'save_hubpost_custom_fields']);
    }
    function save_hubpost_custom_fields($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (get_post_type($post_id) !== 'hubpost') {
            return;
        }

        if (isset($_POST['name'])) {
            update_post_meta($post_id, 'name', sanitize_text_field($_POST['name']));
        }

        if (isset($_POST['account_name'])) {
            update_post_meta($post_id, 'account_name', sanitize_text_field($_POST['account_name']));
        }

        if (isset($_POST['major'])) {
            update_post_meta($post_id, 'major', sanitize_text_field($_POST['major']));
        }

        if (isset($_POST['phone'])) {
            update_post_meta($post_id, 'phone', sanitize_text_field($_POST['phone']));
        }
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
        $name = get_post_meta(get_the_ID(), 'name', true);
        $account_name = get_post_meta(get_the_ID(), 'account_name', true);
        $major = get_post_meta(get_the_ID(), 'major', true);
        $phone = get_post_meta(get_the_ID(), 'phone', true);

        echo '
        <div class="row">
                <div class="col-md-6">
                    <label for="name" class="fw-bold">Name <span class="text-danger">*</span></label>
                    <input id="hubpost-cf-name" class="form-control" name="name" value="' . $name . '">
                    <span id="error_name" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="account_name" class="fw-bold">Account name</label>
                    <input id="account_name" class="form-control" name="account_name" value="' . $account_name . '">
                </div>
                <div class="col-md-6">
                    <label for="major" class="fw-bold">Major</label>
                    <input id="major" class="form-control" name="major" value="' . $major . '">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="fw-bold">Phone</label>
                    <input id="phone" class="form-control" name="phone" value="' . $phone . '">
                    <span id="error_phone" class="text-danger"></span>
                </div>
        </div>
        <script>
            if(jQuery("#hubpost-cf-name").val() == ""){
                jQuery(".editor-post-publish-button").prop("disabled", true);
            }
            jQuery("#hubpost-cf-name").on("keyup",function(){
                if(jQuery(this).val() == ""){
                    jQuery(".editor-post-publish-button").prop("disabled", true);
                    jQuery("#error_name").html("Please fill in the blank fields.");
                }else{
                    jQuery(".editor-post-publish-button").prop("disabled", false);
                    jQuery("#error_name").html("");

                }
            })
        </script>
        ';
    }
}

new Extend_Custom_Field_Hubpost;
