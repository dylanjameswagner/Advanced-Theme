<?php

/* theme options */

    function carbon_after_setup_theme(){
        add_theme_support('html5',array('search-form','comment-list','comment-form','gallery','caption'));
    }
    add_action('after_setup_theme','carbon_after_setup_theme');
