<?php

/* register acf options page */

    if (function_exists('acf_add_options_page')){

        acf_add_options_page(); // Options
        // acf_add_options_page(array(
        //  'page_title'    => 'Theme General Settings',
        //  'menu_title'    => 'Theme Settings',
        //  'menu_slug'     => 'theme-general-settings',
        //  'capability'    => 'edit_posts',
        //  'redirect'      => false
        // ));
    }

    if (function_exists('acf_add_options_sub_page')){

        acf_add_options_sub_page('Options');
        // acf_add_options_sub_page('Header');
        // acf_add_options_sub_page('Footer');
        // acf_add_options_sub_page('Content');

        // type archive
        // acf_add_options_sub_page(array(
        //  'title'         => '{TYPE} Archive Options',    // required
        //  'menu'          => 'Archive Options',           // default title
        //  'slug'          => 'options-{TYPE}',            // default sanitized title
        //  'parent'        => 'edit.php?post_type={TYPE}', // default admin.php?page=acf-options-options
        //  'capability'    => 'manage_options',            // default manage_options
        // ));

        // acf_add_options_sub_page(array(
        //  'title'         => 'Portfolio Archive Options',     // required
        //  'menu'          => 'Archive Options',               // default title
        //  'slug'          => 'options-project',               // default sanitized title
        //  'parent'        => 'edit.php?post_type=project',    // default admin.php?page=acf-options-options
        //  'capability'    => 'manage_options',                // default manage_options
        // ));
    }

/* add admin bar node for archive pages */

    function carbon_edit_archive($wp_admin_bar){

        if (is_post_type_archive()) :

            // FIXME explore $GLOBALS['acf_options_pages']
            $array = array('project'); // available options sub page

            if (in_array(get_post_type(),$array)) :

                // match type to options sub page slug
                $type   = get_post_type();
                $url    = !$type ? null : 'edit.php?post_type='.$type.'&page=options-'.$type;

            else :

                // match rewrite slug with page slug
                $slug   = get_post_type_object(get_post_type())->rewrite['slug'];
                $page   = get_page_by_path($slug);
                $id     = $page ? $page->ID : null;
                $url    = !$id ? null : 'post.php?post='.$id.'&amp;action=edit';

            endif;

            if ($url) :
                $args = array(
                    'id'    => 'edit', // match page_for_posts
                    'title' => 'Edit Page', // match page_for_posts
                    'href'  => admin_url($url),
                );
                $wp_admin_bar->add_node($args);
            endif;

        endif;
    }
    add_action('admin_bar_menu','carbon_edit_archive',999);
