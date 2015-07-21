<?php

/* register posts types */

    function carbon_register_post_types(){

        // carbon_register_post_type(array(
        //     'singular'    => 'Type',  // required
        //     'plural'      => 'Types', // required
        //     'type'        => 'type',  // required
        //     'slug'        => 'types/type',
        //     'menu_icon'   => 'dashicons-admin-post',
        //     'has_archive' => true,
        //     'exclude_from_search' => true,
        // ));
    }

/* register posts type */

    function carbon_register_post_type($settings){

        $labels = array(
            'name'               => _x($settings['plural'],'post type plural name','carbon'),
            'singular_name'      => _x($settings['singular'],'post type singular name','carbon'),
            'add_new'            => _x('Add New',$settings['singular'],'carbon'),
            'add_new_item'       => __('Add New ' .$settings['singular']),
            'edit_item'          => __('Edit '    .$settings['singular']),
            'new_item'           => __('New '     .$settings['singular']),
            'all_items'          => __('All '     .$settings['plural']),
            'view_item'          => __('View '    .$settings['singular']),
            'search_items'       => __('Search '  .$settings['plural']),
            'not_found'          => __('No '      .$settings['plural'].' found'),
            'not_found_in_trash' => __('No '      .$settings['plural'].' found in Trash'),
            'parent_item_colon'  => ':',
            'menu_name'          => $settings['plural'],
        );

        $args = array(
            'labels'              => $labels,
            'can_export'          => (isset($settings['can_export'])          ? $settings['can_export']          : true), // defaults true
            'capability_type'     => (isset($settings['capability_type'])     ? $settings['behavior']            : 'post'), // default post
            // 'capabilities' // default capability_type
            'exclude_from_search' => (isset($settings['exclude_from_search']) ? $settings['exclude_from_search'] : false), // default opposite of public
            'hierarchical'        => (isset($settings['hierarchical'])        ? $settings['hierarchical']        : false), // default false
            'has_archive'         => (isset($settings['has_archive'])         ? $settings['has_archive']         : false), // default false
            // 'permalink_epmask' // default EP_PERMALINK
            'public'              => (isset($settings['public'])              ? $settings['public']              : true), // default false
            'publicly_queryable'  => (isset($settings['publicly_queryable'])  ? $settings['publicly_queryable']  : true), // default public
            'query_var'           => (isset($settings['query_var'])           ? $settings['query_var']           : true), // default true type
            'show_ui'             => (isset($settings['show_ui'])             ? $settings['show_ui']             : true), // default public
            'show_in_menu'        => (isset($settings['show_in_menu'])        ? $settings['show_in_menu']        : true), // default public
            'show_in_admin_bar'   => (isset($settings['show_in_admin_bar'])   ? $settings['show_in_admin_bar']   : true), // default show_in_menu
            'menu_position'       => (isset($settings['menu_position'])       ? $settings['menu_position']       : null), // default null
            'menu_icon'           => (isset($settings['menu_icon'])           ? $settings['menu_icon']           : 'dashicons-admin-post'),
            'supports'            => (isset($settings['supports'])            ? $settings['supports']            : array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes')), // default title editor
            'taxonomies'          => (isset($settings['taxonomies'])          ? $settings['taxonomies']          : array()), // default none
            // 'register_meta_box_cb' // default none
            'rewrite'             => (isset($settings['rewrite'])             ? $settings['rewrite']             : array( // default true name
                'slug'            => (isset($settings['slug'])                ? $settings['slug']                : $settings['type']), // default type
                'with_front'      => (isset($settings['with_front'])          ? $settings['with_front']          : false), // default true
                'feeds'           => (isset($settings['feeds'])               ? $settings['feeds']               : false), // default has_archive
                'pages'           => (isset($settings['pages'])               ? $settings['pages']               : true), // defaults true
                // 'ep_mask' // default permalink_epmask EP_PERMALINK
            )),
        );
        register_post_type($settings['type'], $args);
    }
    add_action('init','carbon_register_post_types');
