<?php

/* admin favicon */

    function carbon_admin_favicon(){
        echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_template_directory_uri().'/public/images/admin/favicon'.(is_user_logged_in() ? '-'.wp_get_current_user()->admin_color : null).'.ico"/>';
    }
    add_action('login_head','carbon_admin_favicon');
    add_action('admin_head','carbon_admin_favicon');

/* theme styles & scripts */

    function custom_wp_enqueue_scripts(){
        wp_register_style('open-sans','http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic'); wp_enqueue_style('open-sans');

        wp_register_style('normalize'   ,get_template_directory_uri().'/public/styles/vendor/normalize-3.0.3.min.css'); wp_enqueue_style('normalize');

        wp_register_style('base'        ,get_template_directory_uri().'/public/styles/base.css'       ); wp_enqueue_style('base');
        wp_register_style('wordpress'   ,get_template_directory_uri().'/public/styles/wordpress.css'  ); wp_enqueue_style('wordpress');
        wp_register_style('constructs'  ,get_template_directory_uri().'/public/styles/constructs.css' ); wp_enqueue_style('constructs');
        wp_register_style('custom'      ,get_template_directory_uri().'/public/styles/custom.css'     ); wp_enqueue_style('custom');

        wp_register_script('html5shiv'  ,get_template_directory_uri().'/public/scripts/vendor/html5shiv-printshiv-3.7.2.min.js'); wp_enqueue_script('html5shiv');
        wp_register_script('prefixfree' ,get_template_directory_uri().'/public/scripts/vendor/prefixfree-1.0.7.min.js'         ); wp_enqueue_script('prefixfree');

        // wp_register_script('custom'     ,get_template_directory_uri().'/public/scripts/custom.js',array('jquery'),false,true); wp_enqueue_script('custom');
    }
    add_action('wp_enqueue_scripts','custom_wp_enqueue_scripts');


/* admin styles */

    function carbon_login_enqueue_scripts(){
        wp_register_style('styles-theme-login',get_template_directory_uri().'/public/styles/login.min.css');
        wp_enqueue_style('styles-theme-login');
    }
    add_action('login_enqueue_scripts','carbon_login_enqueue_scripts');

    function carbon_admin_enqueue_scripts(){
        wp_register_style('styles-theme-admin',get_template_directory_uri().'/public/styles/admin.min.css');
        wp_enqueue_style('styles-theme-admin');

        wp_register_script('scripts-theme-admin',get_template_directory_uri().'/public/scripts/admin.min.js',array('jquery'));
        wp_enqueue_script('scripts-theme-admin');
    }
    add_action('admin_enqueue_scripts','carbon_admin_enqueue_scripts');
