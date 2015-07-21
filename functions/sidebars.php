<?php

/* register widget sections */

    function carbon_register_sidebars(){

        // carbon_register_sidebar(array(
        //     'name' => 'Sidebar', // required
        // ));

        carbon_register_sidebar(array(
            'name' => 'Posts', // required
        ));

        carbon_register_sidebar(array(
            'name' => 'Pages', // required
        ));
    }

/* register widget section */

    function carbon_register_sidebar($settings){

        register_sidebar(array(
            'id'            => sanitize_title($settings['name']),
            'name'          => $settings['name'],
            'before_widget' => '<aside id="%1$s" class="widget %2$s">'.PHP_EOL,
            'after_widget'  => '</aside>'.PHP_EOL,
            'before_title'  => '<h3 class="heading">',
            'after_title'   => '</h3>'.PHP_EOL,
        ));
    }
    add_action('widgets_init','carbon_register_sidebars');
