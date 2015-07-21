<?php

/* register taxonomies */

    function carbon_register_taxonomies(){

        // carbon_register_taxonomy(array(
        //     'type'      => array('type'),     // required
        //     'singular'  => 'Type Category',   // required
        //     'plural'    => 'Type Categories', // required
        //     'taxonomy'  => 'type-category',   // required
        //     'slug'      => 'types/categories',
        //     'menu_name' => 'Categories',
        // ));
    }

/* register taxonomy */

    function carbon_register_taxonomy($settings){

        $labels = array(
            'name'              => _x($settings['plural'],'taxonomy plural name','carbon'),
            'singular_name'     => _x($settings['singular'],'taxonomy singular name','carbon'),
            'menu_name'         => __(isset($settings['menu_name']) ? $settings['menu_name'] : $settings['plural']),
            'all_items'         => __('All '     .$settings['plural']),
            'edit_item'         => __('Edit '    .$settings['singular']),
            'view_item'         => __('View '    .$settings['singular']),
            'update_item'       => __('Update '  .$settings['singular']),
            'add_new_item'      => __('Add New ' .$settings['singular']),
            'new_item_name'     => __('New '     .$settings['singular'].' Name'),
            'parent_item'       => __('Parent '  .$settings['singular']),
            'parent_item_colon' => __('Parent '  .$settings['singular'].':'),
            'search_items'      => __('Search '  .$settings['plural']),
            // popular_items
            // separate_items_with_commas
            // add_or_remove_items
            // choose_from_most_used
            // not_found
        );

        $args = array(
            'labels'            => $labels,
            // capabilities
            'hierarchical'      => (isset($settings['hierarchical'])      ? $settings['hierarchical']      : true), // default false
            'meta_box_cb'       => (isset($settings['meta_box_cb'])       ? $settings['meta_box_cb']       : null), // post_categories_meta_box post_tags_meta_box
            'public'            => (isset($settings['public'])            ? $settings['public']            : true), // default true
            'query_var'         => (isset($settings['query_var'])         ? $settings['query_var']         : true), // default true type
            'show_ui'           => (isset($settings['show_ui'])           ? $settings['show_ui']           : true), // default public
            'show_in_nav_menus' => (isset($settings['show_in_nav_menus']) ? $settings['show_in_nav_menus'] : true), // default public
            'show_tagcloud'     => (isset($settings['show_tagcloud'])     ? $settings['show_tagcloud']     : true), // default show_ui
            'show_admin_column' => (isset($settings['show_admin_column']) ? $settings['show_admin_column'] : true), // default false
            'sort'              => (isset($settings['sort'])              ? $settings['sort']              : null), // default null
            'rewrite'           => (isset($settings['rewrite'])           ? $settings['rewrite']           : array( // default true name
                'slug'          => (isset($settings['slug'])              ? $settings['slug']              : $settings['type']), // default type
                'with_front'    => (isset($settings['with_front'])        ? $settings['with_front']        : false), // default true
                'hierarchical'  => (isset($settings['hierarchical'])      ? $settings['hierarchical']      : false), // default
                // 'ep_mask' // default permalink_epmask EP_PERMALINK
            )),
        );
        register_taxonomy($settings['taxonomy'],$settings['type'],$args);
    }
    add_action('init','carbon_register_taxonomies');
