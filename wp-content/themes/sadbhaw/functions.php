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
	global $wpdb;
	if (!empty($_POST['full-name']) && !empty($_POST['email'])){
		$wpdb->insert('wp_sadbhaw_partners',array('name' => $_POST['full-name'],
																								'email' => $_POST['email'],
																								'address' => $_POST['address']
																								));
		$message = '';
		$message .= "The following person has tried to register as a partner\n\n";
		$message .= "Name : ".$_POST['full-name']."\n";
		$message .= "Email : ".$_POST['email']."\n";
		$message .= "Address : ".$_POST['address']."\n";
		wp_mail(get_bloginfo('admin_email'),'Sadbhaw Partner Registration',$message);
		wp_redirect(site_url('thank-you?redirect=partner'));
		die;
	}
	else{
		wp_redirect($_SERVER['HTTP_REFERER']."?submit=false&form=partner");
		die;
	}
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
		wp_redirect(site_url('thank-you?redirect=volunteer'));
		die;
	}
	else{
		wp_redirect($_SERVER['HTTP_REFERER']."?submit=false&form=volunteer");
		die;
	}
}
add_action('admin_post_become_a_volunteer','become_a_volunteer');
add_action('admin_post_nopriv_become_a_volunteer','become_a_volunteer');

//Handles the become an ambassador form submit
function become_an_ambassador(){
	global $wpdb;
	if (!empty($_POST['full-name']) && !empty($_POST['email'])){
		$wpdb->insert('wp_sadbhaw_ambassadors',array('name' => $_POST['full-name'],
																								'email' => $_POST['email'],
																								'address' => $_POST['address']
																								));
		$message = '';
		$message .= "The following person has tried to register as an ambassador\n\n";
		$message .= "Name : ".$_POST['full-name']."\n";
		$message .= "Email : ".$_POST['email']."\n";
		$message .= "Address : ".$_POST['address']."\n";
		wp_mail(get_bloginfo('admin_email'),'Sadbhaw Ambassador Registration',$message);
		wp_redirect(site_url('thank-you?redirect=ambassador'));
		die;
	}
	else{
		wp_redirect($_SERVER['HTTP_REFERER']."?submit=false&form=ambassador");
		die;
	}
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
		$token = get_token(20);
		//Save donator info
		$wpdb->insert('wp_sadbhaw_donators',array('name' => $_POST['donate']['name'],
																							'email' => $_POST['donate']['email'],
																							'address' => $_POST['donate']['address'],
																							'zip' => $_POST['donate']['city'],
																							'phone' => $_POST['donate']['phone'],
																							'donated_amount' => $_POST['donate']['sponsor'],
																							'pledged' => 0,
																							'token' => 20));
		$id = $wpdb->insert_id;
		//Redirect to payment select page
		wp_redirect(site_url('/payment-options/?_donation_nonce=').$_POST['_donation_nonce']."&id={$id}");
		die;
	//For I pledge button
	}elseif ($_POST['submit'] == 'I Pledge'){
		global $wpdb;
		//Save donator info
		$wpdb->insert('wp_sadbhaw_donators',array('name' => $_POST['donate']['name'],
																							'email' => $_POST['donate']['email'],
																							'address' => $_POST['donate']['address'],
																							'zip' => $_POST['donate']['city'],
																							'phone' => $_POST['donate']['phone'],
																							'donated_amount' => $_POST['donate']['sponsor'],
																							'pledged' => 1,
																							'verified' => 1));
		wp_redirect(site_url('thank-you?redirect=pledge'));
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


//Handles the contact form
function contact_us(){
	global $wpdb;
	if (!empty($_POST['full-name']) && !empty($_POST['email']) && !empty($_POST['message'])){
		$message = '';
		$message .= "The following person tried to contact you\n\n";
		$message .= "Name : ".$_POST['full-name']."\n";
		$message .= "Email : ".$_POST['email']."\n";
		$message .= "Message : ".$_POST['message']."\n";
		wp_mail(get_bloginfo('admin_email'),'Sadbhaw Contact Us',$message);
		wp_redirect(site_url('thank-you?redirect=contact'));
		die;
	}
	else{
		wp_redirect($_SERVER['HTTP_REFERER']."?submit=false&form=contact");
		die;
	}
}
add_action('admin_post_contact_us','contact_us');
add_action('admin_post_nopriv_contact_us','contact_us');

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

/**
 * Allow comma separted emails in admin email settings
 */
function sanitize_multiple_emails($value,$oldValue)
{
		//if anything is fishy, just trust wp to keep on as it would.
		if(!isset($_POST["admin_email"]))
				return $value;

		$result = "";
		$emails = explode(",",$_POST["admin_email"]);
		foreach($emails as $email)
		{
				$email = trim($email);
				$email = sanitize_email( $email );

				//again, something wrong? let wp keep at it.
				if(!is_email($email))
						return $value;
				$result .= $email.",";

		}

		if(strlen($result == ""))
				return $value;
		$result = substr($result,0,-1);
		return $result;
}
add_filter('pre_update_option_admin_email','sanitize_multiple_emails',10,2);

/**
 * Covert currency from one country to another
 */
function currencyConverter($currency_from,$currency_to,$currency_input){
	$yql_base_url = "http://query.yahooapis.com/v1/public/yql";
  $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
  $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
  $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
  $yql_session = file_get_contents($yql_query_url);
  $yql_json =  json_decode($yql_session,true);
  $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];
  return $currency_output;
}

/**
 * Random token generation
 */
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}


function sadbhaw_story_type_metabox( $post ) {
  //Get taxonomy and terms
  $taxonomy = 'story-type';
  //Set up the taxonomy object and get terms
  $tax = get_taxonomy($taxonomy);
  $terms = get_terms($taxonomy,array('hide_empty' => 0));

  //Name of the form
  $name = 'tax_input[' . $taxonomy . ']';

  $postterms = get_the_terms( $post->ID,$taxonomy );
  $current = ($postterms ? array_pop($postterms) : false);
  $current = ($current ? $current->term_id : 0);
  ?>

  <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
      <!-- Display tabs-->
      <ul id="<?php echo $taxonomy; ?>-tabs" class="category-tabs">
          <li class="tabs"><a href="#<?php echo $taxonomy; ?>-all" tabindex="3"><?php echo $tax->labels->all_items; ?></a></li>
      </ul>
      <!-- Display taxonomy terms -->
      <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
          <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
              <?php   foreach($terms as $term){
                  $id = $taxonomy.'-'.$term->term_id;
                  echo "<li id='$id'><label class='selectit'>";
                  echo "<input type='radio' id='in-$id' name='{$name}'".checked($current,$term->term_id,false)."value='$term->term_id' />$term->name<br />";
                 echo "</label></li>";
              }?>
         </ul>
      </div>
  </div>
  <?php
}