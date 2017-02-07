<?php
/**
 * Enqueue scripts and styles.
 */
function sadhbaw_scripts(){
  //Bootstrap CSS
  wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
  //Font Awesome
  wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome/font-awesome.min.css');
  //iw shortcode css
  wp_enqueue_style('iw-shortcode', get_template_directory_uri() . '/css/iw-shortcodes.css');
  //js-composer css
  wp_enqueue_style('js-composer', get_template_directory_uri() . '/css/js_composer.min.css');
  //Google Font
  wp_enqueue_style('google-font-1','http://fonts.googleapis.com/css?family=Roboto+Slab%3A100%2C300%2C400%2C700&amp;ver=1.5.0');
  wp_enqueue_style('google-font-2','http://fonts.googleapis.com/css?family=ABeeZee%3A100%2C300%2C400%2C700&amp;ver=1.5.0');
  //InCharity Theme Base Stylesheet
  wp_enqueue_style('main', get_template_directory_uri() . '/style.css');
  //Responsive CSS
  wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
  //Infunding plugin css
  wp_enqueue_style('infunding-css', get_template_directory_uri() . '/css/infunding_style.css');
  //Custom Stylesheet
  wp_enqueue_style('custom', get_template_directory_uri() . '/css/custom.css');

  //Google Maps API
  wp_enqueue_script('google-maps-api',"https://maps.googleapis.com/maps/api/js?key=AIzaSyAxP_6_jfGs_RuL61axoXVEyyvPV1Wu-lI",'','',true);
  wp_enqueue_script('acf-maps',get_template_directory_uri()."/js/acf-googlemap.js",'','',true);
  //Bootstrap JS
  wp_enqueue_script('bootstrap-js',get_template_directory_uri() . '/js/bootstrap.min.js','','',true);

  wp_enqueue_script('countdown-js',get_template_directory_uri() . '/js/jquery.countdown.min.js','','',true);
  //Custom JS
  wp_enqueue_script('custom-js',get_template_directory_uri() . '/js/custom.js','','',true);
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
  global $wpdb;
  if (!empty($_POST['first-name']) && !empty($_POST['last-name']) && !empty($_POST['email'])){
    $wpdb->insert('wp_sadbhaw_volunteers',array('first_name' => $_POST['first-name'],
                                                'last_name' => $_POST['last-name'],
                                                'email' => $_POST['email'],
                                                'address' => $_POST['address'],
                                                'city' => $_POST['city'],
                                                'phone' => $_POST['phone'],
                                                'gender' => $_POST['gender'],
                                                'education' => $_POST['education'],
                                                'skill' => json_encode($_POST['skill']),
                                                'language' => json_encode($_POST['language']),
                                                'availability' => json_encode($_POST['availability']),
                                                'transportation' => $_POST['transportation'],
                                                'emergency' => json_encode($_POST['emergency'])
                                                ));
    $message = '';
    $message .= "The following person has tried to register as a volunteer\n\n";
    $message .= "First Name : ".$_POST['first-name']."\n";
    $message .= "Last Name : ".$_POST['last-name']."\n";
    $message .= "Email : ".$_POST['email']."\n";
    $message .= "Address : ".$_POST['address']."\n";
    $message .= "City/State/Zip : ".$_POST['city']."\n";
    $message .= "Phone : ".$_POST['phone']."\n";
    $message .= "Gender : ".$_POST['gender']."\n";
    $message .= "Education : ".$_POST['education']."\n";
    $message .= "Skills : \n";
    foreach ($_POST['skill'] as $skill) {
      $message .= $skill['name']." - ".$skill['proficiency']."\n";
    }
    $message .= "Language : \n";
    foreach ($_POST['language'] as $language) {
      $message .= $language['name']." - ".$language['proficiency']."\n";
    }
    $message .= "Available Days : ".$_POST['availability']['no-of-days']."\n";
    $message .= "Days : ".implode(',',array_keys($_POST['availability']['days']))."\n";
    $message .= "Transportation : ".$_POST['transportation']."\n";
    $message .= "Emergency Contact : \n";
    $emergency = $_POST['emergency'];
    $message .= "First Name : ".$emergency['first-name']."\n";
    $message .= "Last Name : ".$emergency['last-name']."\n";
    $message .= "Address : ".$emergency['address']."\n";
    $message .= "City/State/Zip : ".$emergency['city']."\n";
    $message .= "Phone : ".$_POST['phone']."\n";
    wp_mail(get_bloginfo('admin_email'),'Sadbhaw Volunteer Registration',$message);
    wp_redirect($_SERVER['HTTP_REFERER']."?submit=true");
    die;
  }
  else{
    wp_redirect($_SERVER['HTTP_REFERER']."?submit=false");
    die;
  }
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
  //Check for empty fields
  $error = [];
  if (empty($_POST['donate']['name'])) $error[] = 'name_empty';
  if (empty($_POST['donate']['email'])) $error[] = 'email_empty';
  if (empty($_POST['donate']['phone'])) $error[] = 'contact_empty';
  if (empty($_POST['donate']['sponsor'])) $error[] = 'sponsor_empty';
  if (!isset($_POST['terms'])) $error[] = 'terms_not_accepted';
  if (!empty($error)){
    session_start();
    $_SESSION['error'] = $error;
    $_SESSION['prev_values'] = $_POST;
    wp_redirect($_SERVER['HTTP_REFERER']);
    die;
  }
  //For donate button
  if ($_POST['submit'] == 'Donate'){
    global $wpdb;
    //Save donator info
    $wpdb->insert('wp_sadbhaw_donators',array('name' => $_POST['donate']['name'],
                                              'email' => $_POST['donate']['email'],
                                              'address' => $_POST['donate']['address'],
                                              'zip' => $_POST['donate']['city'],
                                              'phone' => $_POST['donate']['phone'],
                                              'donated_amount' => $_POST['donate']['sponsor']));
    $id = $wpdb->insert_id;
    //Redirect to payment select page
    wp_redirect(site_url('/payment-options/?_donation_nonce=').$_POST['_donation_nonce']."&id={$id}");
    die;
  //For I pledge button
  }elseif ($_POST['submit'] == 'I Pledge'){
    wp_redirect(site_url('thank-you'));
    die;
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

/**
 * Google Map API key
 * @param  Array  $api  API array
 * @return Array        Updated API array
 */
function sadbhaw_google_map_api( $api ){
  $api['key'] = 'AIzaSyAxP_6_jfGs_RuL61axoXVEyyvPV1Wu-lI';
  return $api;
}
add_filter('acf/fields/google_map/api', 'sadbhaw_google_map_api');

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
  }
// add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
  global $post;
  if ( !is_singular()) //if it is not a post or a page
    return;
        echo '<meta property="fb:admins" content="1385322881512772"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Sadbhaw"/>';
  if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
    $default_image=get_template_directory_uri().'/images/logos/logo_big.png'; //replace this with a default image on your server or an image in your media library
    echo '<meta property="og:image" content="' . $default_image . '"/>';
  }
  else{
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
  }
  echo "
";
}
// add_action( 'wp_head', 'insert_fb_in_head', 5 );