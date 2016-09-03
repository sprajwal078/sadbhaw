<?php
/**
 * Enqueue scripts and styles.
 */
/**
 * This theme uses wp_nav_menu() in two locations.
 **/
register_nav_menus( array(
    'header' => __( 'Header Sadbhaw Menu', 'sadbhaw' ),
    'footer'  => __( 'Footer Sadbhaw Menu', 'sadbhaw' ),
) );

/**
<<<<<<< HEAD
 * @param $args
 * @return WP_Query
 */
function generate_query( $args ){
    $query = new WP_Query($args);
    return $query;
}

/**
=======
>>>>>>> 74363f09b9f90cec21f3267e3fdad4c178feb268
 * @param $menu_id
 * @return null
 */
function get_menu_tree( $menu_id ){
    $items = wp_get_nav_menu_items( $menu_id );
    return  $items ? buildTree( $items, 0 ) : null;
}

/**
 * @param array $elements
 * @param int $parentId
 * @return array
 */
function buildTree( array &$elements, $parentId = 0 ){
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = buildTree( $elements, $element->ID );
            if ( $children )
                $element->children = $children;

            $branch[$element->ID] = $element;
            unset( $element );
        }
    }
    return $branch;
}


function list_terms_by_post_type($taxonomy = 'category',$post_type = 'post'){
    //get a list of all post of your type
    $args = array(
        'posts_per_page' => -1,
        'post_type' => $post_type
    );
    $terms= array();
    $posts = get_posts($args);
    foreach($posts as $p){
        //get all terms of your taxonomy for each type
        $ts = wp_get_object_terms($p->ID,$taxonomy);
        foreach ( $ts as $t ) {
            if (!in_array($t,$terms)){ //only add this term if its not there yet
                $terms[] = $t;
            }
        }
    }
    wp_reset_postdata();
    return $terms;
}



