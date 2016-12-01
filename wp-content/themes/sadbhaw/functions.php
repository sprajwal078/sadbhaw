<?php
/**
 * Enqueue scripts and styles.
 */
function sadhbaw_scripts(){
  //InCharity Theme Base Stylesheet
  wp_enqueue_style('main', get_template_directory_uri() . '/style.css', array());
  //Custom Stylesheet
  wp_enqueue_style('custom', get_template_directory_uri() . '/css/custom.css', array());
}
add_action('wp_enqueue_scripts','sadhbaw_scripts');

/**
 * This theme uses wp_nav_menu() in two locations.
 **/
register_nav_menus( array(
    'header' => __( 'Header Sadbhaw Menu', 'sadbhaw' ),
    'footer'  => __( 'Footer Sadbhaw Menu', 'sadbhaw' ),
) );

/**
 * @param $args
 * @return WP_Query
 */
function generate_query( $args ){
    $query = new WP_Query($args);
    return $query;
}

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
            $order = get_field('order', $t->taxonomy.'_'.$t->term_id);

            if (!in_array($t,$terms)){ //only add this term if its not there yet
                $terms[$order] = $t;
            }

        }

    }

    ksort($terms);
    wp_reset_postdata();
    return $terms;
}

/*----------  Form Handling  ----------*/

//Handles the become a partner form submit
function become_a_partner(){
  echo "Thank you for being a partner";
}
add_action('admin_post_become_a_partner','become_a_partner');
add_action('admin_post_nopriv_become_a_partner','become_a_partner');

//Handles the become a volunteer form submit
function become_a_volunteer(){
  echo "Thank you for being a volunteer";
}
add_action('admin_post_become_a_volunteer','become_a_volunteer');
add_action('admin_post_nopriv_become_a_volunteer','become_a_volunteer');

//Handles the become an ambassador form submit
function become_an_ambassador(){
  echo "Thank you for being an ambassador";
}
add_action('admin_post_become_an_ambassador','become_an_ambassador');
add_action('admin_post_nopriv_become_an_ambassador','become_an_ambassador');

//Handles the become an ambassador form submit
function donate_us(){
  //For donate button
  if ($_POST['submit'] == 'Donate'){
    //Check if the terms are accepted
    if ($_POST['terms'] == 'accept'){
      wp_redirect(site_url('/payment/?_donation_nonce=').$_POST['_donation_nonce']);
      die;
    }
  //For I pledge button
  }elseif ($_POST['submit'] == 'I Pledge'){
    wp_redirect(site_url('thank-you'));
    die;
    //Get email address of site admin
    // $email = get_option('admin_email');
    // wp_mail($email,'')
  }
}
add_action('admin_post_donate_us','donate_us');
add_action('admin_post_nopriv_donate_us','donate_us');

//Handles the payment method form submit
function payment_method(){
  //For esewa
  if ($_POST['payment_method'] == 'esewa') {
    echo "Esewa selected";
  //For skrill
  }elseif ($_POST['payment_method'] == 'skrill') {
    echo "Skrill selected";
  //For paypal
  }elseif ($_POST['payment_method'] == 'paypal') {
    echo "Paypal selected";
  }
}
add_action('admin_post_payment_method','payment_method');
add_action('admin_post_nopriv_payment_method','payment_method');


//Handles the we visit you form submit
function we_visit_you(){
  echo "We will visit you on your specified day";
}
add_action('admin_post_we_visit_you','we_visit_you');
add_action('admin_post_nopriv_we_visit_you','we_visit_you');

/*----------  Form Handling Ends  ----------*/
