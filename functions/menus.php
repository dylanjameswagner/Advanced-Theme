<?php

/* register menus */

    function carbon_register_nav_menus($menu){

        register_nav_menus(array(
            'header' => __('Header Location','carbon'),
            'footer' => __('Footer Location','carbon'),
        ));
    }
    add_action('init','carbon_register_nav_menus');

/* add meta box type */
/* https://gist.github.com/eduardozulian/4a857c671751f34cf7be */
/**
 * Callback function for taxonomy meta boxes
 *
 * A simple callback function for 'meta_box_cb' argument
 * inside register_taxonomy() that replaces the regular
 * checkboxes with a plain dropdown list
 *
 * @param  [type] $post [description]
 * @param  [type] $box  [description]
 * @link   http://wordpress.stackexchange.com/a/148965
 *
 * use     'meta_box_cb' => 'carbon_taxonomy_meta_box',
 */

    function carbon_taxonomy_meta_box($post,$box){

        $defaults = array('taxonomy'=>'category');

        if (!isset($box['args']) || !is_array($box['args'])){
            $args = array();
        }
        else {
            $args = $box['args'];
        }

        extract(wp_parse_args($args,$defaults),EXTR_SKIP);

        echo '<div id="taxonomy-'.$taxonomy.'" class="categorydiv">';

        $name = ($taxonomy == 'category') ? 'post_category' : 'tax_input['.$taxonomy.']';

        echo '<input type="hidden" name="'.$name.'[]" value="0" />'; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.

        $term_obj = wp_get_object_terms($post->ID,$taxonomy); //_log($term_obj[0]->term_id)
        $plural     = get_taxonomy($taxonomy)->labels->name;
        $singular   = get_taxonomy($taxonomy)->labels->singular_name;

        echo '<p>';
        echo '<label class="screen-reader-text" for="'.$name.'">'.$plural.'</label>';

        wp_dropdown_categories(array(
            'taxonomy'          => $taxonomy,
            'hide_empty'        => false,
            'name'              => $name,
            'class'             => 'widefat',
            // 'hierarchical'       => 0,
            'selected'          => !empty($term_obj) ? $term_obj[0]->term_id : null,
            'orderby'           => 'name',
            'order'             => 'ASC',
            // 'show_option_none'   => 'Select '.$plural,
            'show_option_none'  => 'Select '.$singular,
        ));

        echo '</p>';
        echo '</div>';

        // TODO add new taxonomy
        // echo '<p>';
        // echo '<label class="screen-reader-text" for="'.$name.'">Add New '.$singular.'</label>';
        // echo '<input type="text" class="widefat" name="'.$name.'" />';
        // echo '</p>';
        // echo '<div id="'.$taxonomy.'-adder" class="wp-hidden-children">';
        // echo '<h4><a id="'.$taxonomy.'-add-toggle" href="#'.$taxonomy.'-add" class="hide-if-no-js">';
        // echo '+ Add New Type Category';
        // echo '</a></h4>';
        // echo '<p id="'.$taxonomy.'-add" class="category-add wp-hidden-child">';
        // echo '<label class="screen-reader-text" for="new'.$taxonomy.'">Add New Type Category</label>';
        // echo '<input type="text" name="'.$name.'" id="new'.$taxonomy.'" class="form-required form-input-tip" aria-required="true">';
        // echo '</p>';
        // echo '</div>';
/*
?>
                <div id="<?php echo $taxonomy; ?>-adder" class="wp-hidden-children">
                    <h4>
                        <a id="<?php echo $taxonomy; ?>-add-toggle" href="#<?php echo $taxonomy; ?>-add" class="hide-if-no-js">
                            + Add New Type Category
                        </a>
                    </h4>
                    <p id="<?php echo $taxonomy; ?>-add" class="category-add wp-hidden-child">
                        <label class="screen-reader-text" for="new<?php echo $taxonomy; ?>">Add New Type Category</label>
                        <input type="text" name="new<?php echo $taxonomy; ?>" id="new<?php echo $taxonomy; ?>" class="form-required form-input-tip" value="New Type Category Name" aria-required="true">
                        <label class="screen-reader-text" for="new<?php echo $taxonomy; ?>_parent">
                            Parent Type Category:                   </label>
<?php
        wp_dropdown_categories(array(
            'taxonomy'          => $taxonomy,
            'hide_empty'        => false,
            'name'              => 'new'.$taxonomy.'_parent',
            'class'             => 'postform',
            'orderby'           => 'name',
            'order'             => 'ASC',
            'show_option_none'  => '&mdash; Parent '.$singular.' &mdash;',
        ));
?>
                        <input type="button" id="<?php echo $taxonomy; ?>-add-submit" data-wp-lists="add:<?php echo $taxonomy; ?>checklist:<?php echo $taxonomy; ?>-add" class="button category-add-submit" value="Add New Type Category">
                        <input type="hidden" id="_ajax_nonce-add-<?php echo $taxonomy; ?>" name="_ajax_nonce-add-<?php echo $taxonomy; ?>" value="db014e8530">                  <span id="<?php echo $taxonomy; ?>-ajax-response"></span>
                    </p>
                </div>
<?php
*/
    }
