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