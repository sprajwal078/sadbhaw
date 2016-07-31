<?php
/**
 * incharity functions and definitions
 *
 * @package incharity
 */

/** define config data */
$inwave_cfg = array();

/** define content width */
$content_width = 1024;

// admin option
require_once(get_template_directory().'/admin/index.php');
include(get_template_directory().'/inc/custom-nav.php');
if (!is_admin()) {
    add_filter('nav_menu_css_class', 'inwave_nav_class', 10, 2);

    function inwave_nav_class($classes, $item)
    {
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'selected active ';
        }
        return $classes;
    }
}

// require main class for theme;
require get_template_directory() . '/inc/main-class.php';

if (!function_exists('inwave_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function inwave_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on incharity, use a find and replace
         * to change 'incharity' to the name of your theme in all the template files
         */
        load_theme_textdomain('incharity', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
		
		//Enables Post Thumbnails support
		add_theme_support( "post-thumbnails" );
		
		//Custom header
		//add_theme_support( "custom-header", array());

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary'           => esc_html__('Primary Menu', 'incharity'),
            'footer-menu'       => esc_html__('Footer Menu','incharity'),
        ));


        //unregister_nav_menu('mega_main_sidebar');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'image', 'gallery', 'video', 'quote', 'link'
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('inwave_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));


    }

endif; // inwave_setup
add_action('after_setup_theme', 'inwave_setup');

/**
 * Enqueue scripts and styles.
 */
function inwave_scripts()
{
    global $inwave_smof_data, $inwave_cfg;

    $theme_info = wp_get_theme();
    if ($inwave_smof_data['fix_woo_jquerycookie']) {
        wp_deregister_script('jquery-cookie');
        wp_register_script('jquery-cookie', get_template_directory_uri() . '/js/jquery-cookie-min.js', array('jquery'), $theme_info->get('Version'), true);
    }

    if ($inwave_smof_data['gf_body'])
        $gfont[urlencode($inwave_smof_data['gf_body'])] = '' . urlencode($inwave_smof_data['gf_body']);
    if ($inwave_smof_data['gf_nav'] && $inwave_smof_data['gf_nav'] != '' && $inwave_smof_data['gf_nav'] != $inwave_smof_data['gf_body'])
        $gfont[urlencode($inwave_smof_data['gf_nav'])] = '' . urlencode($inwave_smof_data['gf_nav']);
    if ($inwave_smof_data['f_headings'] && $inwave_smof_data['f_headings'] != '' && $inwave_smof_data['f_headings'] != $inwave_smof_data['gf_body'] && $inwave_smof_data['f_headings'] != $inwave_smof_data['gf_nav'])
        $gfont[urlencode($inwave_smof_data['f_headings'])] = '' . urlencode($inwave_smof_data['f_headings']);
    if (isset($gfont) && $gfont) {
        foreach ($gfont as $key => $g_font) {
            wp_enqueue_style('google-font-'.sanitize_title($key),"//fonts.googleapis.com/css?family={$g_font}:" . $inwave_smof_data['gf_settings'], array(), $theme_info->get('Version'));
        }
    }
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), $theme_info->get('Version'));
	
	wp_enqueue_style('select2-css', get_template_directory_uri() . '/css/select2.css', array(), $theme_info->get('Version'));
	
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.css', array(), $theme_info->get('Version'));
	
	wp_enqueue_style('pwsignaturetwo', get_template_directory_uri() . '/fonts/pwsignaturetwo/stylesheet.css', array(), $theme_info->get('Version'));
	wp_enqueue_style('woocommece', get_template_directory_uri() . '/css/woocommece.css', array(), $theme_info->get('Version'));

	wp_enqueue_style('custombox', get_template_directory_uri() . '/css/custombox.min.css', array(), $theme_info->get('Version'));
    
    // Don't load css3 effect in mobile device
	
	if (!wp_is_mobile()) {
		if(!(isset($_REQUEST['vc_editable']) && $_REQUEST['vc_editable'])){
			wp_enqueue_style('incharity-animation', get_template_directory_uri() . '/css/animation.css', array(), $theme_info->get('Version'));
		}
	}

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), $theme_info->get('Version'));
    wp_enqueue_style('owl-transitions', get_template_directory_uri() . '/css/owl.transitions.css', array(), $theme_info->get('Version'));
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), $theme_info->get('Version'));

    /** Theme style */
    wp_enqueue_style('incharity-style', get_stylesheet_uri());
    wp_enqueue_style('incharity-responsive', get_template_directory_uri() . '/css/responsive.css', array(), $theme_info->get('Version'));
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), $theme_info->get('Version'));
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), $theme_info->get('Version'));
    wp_enqueue_style('owl-transitions', get_template_directory_uri() . '/css/owl.transitions.css', array(), $theme_info->get('Version'));

    /* Load jquery lib*/
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), $theme_info->get('Version'), true);
    wp_enqueue_script('addition', get_template_directory_uri() . '/js/addition.js', array(), $theme_info->get('Version'), true);
    wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), $theme_info->get('Version'), true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), $theme_info->get('Version'), true);
	wp_enqueue_script('custombox', get_template_directory_uri() . '/js/custombox.min.js', array(), $theme_info->get('Version'), true);
	
	wp_enqueue_script('select2.full', get_template_directory_uri() . '/js/select2.full.js', array(), $theme_info->get('Version'), true);
	wp_enqueue_script('icheck', get_template_directory_uri() . '/js/icheck.js', array(), $theme_info->get('Version'), true);
	
    /* Load only page request*/
    wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.js', array(), $theme_info->get('Version'), true);

    if ($inwave_smof_data['retina_support']) {
        wp_enqueue_script('retina_js', get_template_directory_uri() . '/js/retina.min.js', array(), $theme_info->get('Version'), true);
    }

    wp_enqueue_script('jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), $theme_info->get('Version'), true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), $theme_info->get('Version'), true);


    wp_enqueue_script('incharity-template', get_template_directory_uri() . '/js/template.js', array(), $theme_info->get('Version'), true);
    wp_localize_script('incharity-template', 'inwaveCfg', array('siteUrl' => admin_url(),'themeUrl'=>get_template_directory_uri(), 'baseUrl' => site_url(), 'ajaxUrl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('incharity-template');
       
	/** Dynamic css color */
	if($inwave_smof_data['show_setting_panel']) {
		wp_enqueue_style('incharity-color', admin_url('admin-ajax.php') . '?action=inwave_color', array(), $theme_info->get('Version'));
        wp_enqueue_script('incharity-panel-settings', get_template_directory_uri() . '/js/panel-settings.js', array(), $theme_info->get('Version'), true);
	}else{	
		wp_enqueue_style('incharity-color',Inwave_Main::getCustomCssUrl().'custom.css', array(), $theme_info->get('Version'));
	}
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'inwave_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

if (!function_exists('inwave_comment')) {

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own inwave_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.

     */
    function inwave_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php esc_html_e('Pingback:', 'incharity'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('(Edit)', 'twentytwelve'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment answer">
                    <div class="commentAvt commentLeft">
                        <?php echo get_avatar(get_comment_author_email() ? get_comment_author_email() : $comment, 91); ?>
                    </div>
                    <!-- .comment-meta -->

                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'incharity'); ?></p>
                    <?php endif; ?>

                    <div class="commentRight">
                        <div class="content-cmt">

                            <span class="name-cmt"><?php echo get_comment_author_link() ?></span>
                            <div class="commentRight-info">
							<span
                                class="date-cmt"><i class="fa fa-clock-o"></i> <?php printf(esc_html__('%s - %s', 'incharity'),get_comment_time(), get_comment_date()) ?>. </span>
                            <span
                                class="comment_reply"><?php comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'incharity'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
							</div>
                            <div class="content-reply">
                                <?php comment_text(); ?>
                            </div>
                        </div>

                        <?php edit_comment_link(esc_html__('Edit', 'incharity'), '<p class="edit-link">', '</p>'); ?>
                    </div>
                    <!-- .comment-content -->
                    <div class="clear"></div>
                </div>
                <!-- #comment-## -->
                <?php
                break;
        endswitch; // end comment_type check
    }

}

if (!function_exists('inwave_getElementsByTag')) {

    /**
     * Function to get element by tag
     * @param string $tag tag name. Eg: embed, iframe...
     * @param string $content content to find
     * @param int $type type of tag. <br/> 1. [tag_name settings]content[/tag_name]. <br/>2. [tag_name settings]. <br/>3. HTML tags.
     * @return type
     */
    function inwave_getElementsByTag($tag, $content, $type = 1)
    {
        if ($type == 1) {
            $pattern = "/\[$tag(.*)\](.*)\[\/$tag\]/Uis";
        } elseif ($type == 2) {
            $pattern = "/\[$tag(.*)\]/Uis";
        } elseif ($type == 3) {
            $pattern = "/\<$tag(.*)\>(.*)\<\/$tag\>/Uis";
        } else {
            $pattern = null;
        }
        $find = null;
        if ($pattern) {
            preg_match($pattern, $content, $matches);
            if ($matches) {
                $find = $matches;
            }
        }
        return $find;
    }

}


if (!function_exists('inwave_social_sharing')) {

    /**
     *
     * @global type $inwave_smof_data
     * @param String $link Link to share
     * @param String $text the text content to share
     * @param String $title the title to share
     * @param String $tag the wrap html tag
     */
    function inwave_social_sharing($link, $text, $title, $tag = '')
    {
        global $inwave_smof_data;
        $newWindow = 'onclick="return iwOpenWindow(this.href);"';
        $title = urlencode($title);
        $text = urlencode($text);
        $link = urlencode($link);
        if ($inwave_smof_data['sharing_facebook']) {
            $shareLink = 'https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . $title . '&amp;p[url]=' . $link . '&amp;p[summary]=' . $text.'&amp;u='. $link;
            echo ($tag ? '<' . $tag . '>' : '') . '<a class="share-buttons-fb" target="_blank" href="#" title="' . esc_attr_x('Share on Facebook','title','incharity') . '" onclick="return iwOpenWindow(\'' . esc_js($shareLink) . '\')"><i class="fa fa-facebook"></i></a>' . ($tag ? '</' . $tag . '>' : '');
        }
        if ($inwave_smof_data['sharing_twitter']) {
            $shareLink = 'https://twitter.com/share?url=' . $link . '&amp;text=' . $text;
            echo ($tag ? '<' . $tag . '>' : '') . '<a class="share-buttons-tt" target="_blank" href="' . esc_url($shareLink) . '" title="' . esc_attr_x('Share on Twitter','title','incharity') . '" ' . $newWindow . '><i class="fa fa-twitter"></i></a>' . ($tag ? '</' . $tag . '>' : '');
        }
        if ($inwave_smof_data['sharing_linkedin']) {
            $shareLink = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . $link . '&amp;title=' . $title . '&amp;summary=' . $text;
            echo ($tag ? '<' . $tag . '>' : '') . '<a class="share-buttons-linkedin" target="_blank" href="' . esc_url($shareLink) . '" title="' . esc_attr_x('Share on Linkedin','title','incharity') . '" ' . $newWindow . '><i class="fa fa-linkedin"></i></a>' . ($tag ? '</' . $tag . '>' : '');
        }
        if ($inwave_smof_data['sharing_google']) {
            $shareLink = 'https://plus.google.com/share?url=' . $link . '&amp;title=' . $title;
            echo ($tag ? '<' . $tag . '>' : '') . '<a class="share-buttons-gg" target="_blank" href="' . esc_url($shareLink) . '" title="' . esc_attr_x('Google Plus','title','incharity') . '" ' . $newWindow . '><i class="fa fa-google-plus"></i></a>' . ($tag ? '</' . $tag . '>' : '');
        }
        if ($inwave_smof_data['sharing_tumblr']) {
            $shareLink = 'http://www.tumblr.com/share/link?url=' . $link . '&amp;description=' . $text . '&amp;name=' . $title;
            echo ($tag ? '<' . $tag . '>' : '') . '<a class="share-buttons-tumblr" target="_blank" href="' . esc_url($shareLink) . '" title="' . esc_attr_x('Share on Tumblr','title','incharity') . '" ' . $newWindow . '><i class="fa fa-tumblr-square"></i></a>' . ($tag ? '</' . $tag . '>' : '');
        }
        if ($inwave_smof_data['sharing_pinterest']) {
            $shareLink = 'http://pinterest.com/pin/create/button/?url=' . $link . '&amp;description=' . $text . '&amp;media=' . $link;
            echo ($tag ? '<' . $tag . '>' : '') . '<a class="share-buttons-pinterest" target="_blank" href="' . esc_url($shareLink) . '" title="' . esc_attr_x('Pinterest','title', 'incharity') . '" ' . $newWindow . '><i class="fa fa-pinterest"></i></a>' . ($tag ? '</' . $tag . '>' : '');
        }
        if ($inwave_smof_data['sharing_email']) {
            $shareLink = 'mailto:?subject=' . esc_attr_x('I wanted you to see this site','title', 'incharity') . '&amp;body=' . $link . '&amp;title=' . $title;
            echo ($tag ? '<' . $tag . '>' : '') . '<a class="share-buttons-email" href="' . esc_url($shareLink) . '" title="' . esc_attr_x('Email','title', 'incharity') . '"><i class="fa fa-envelope"></i></a>' . ($tag ? '</' . $tag . '>' : '');
        }
    }


}

if (!function_exists('inwave_get_class')) {

    function inwave_get_classes($type,$sidebar)
    {
        $classes = '';
        switch ($type) {
            case 'container':
                $classes = 'col-sm-12 col-xs-12';
                if ($sidebar == 'left' || $sidebar == 'right') {
                    $classes .= ' col-lg-9 col-md-8';
                    if ($sidebar == 'left') {
                        $classes .= ' pull-right';
                    }
                }
                break;
            case 'sidebar':
                $classes = 'col-sm-12 col-xs-12';
                if ($sidebar == 'left' || $sidebar == 'right') {
                    $classes .= ' col-lg-3 col-md-4';
                }
                if ($sidebar == 'bottom') {
                    $classes .= ' pull-' . $sidebar;
                }
                break;
        }
        return $classes;


    }

}
if (!function_exists('inwave_get_extend_tags')) {

    function inwave_get_extend_tags()
    {
        $inwave_input_allowed = wp_kses_allowed_html('post');
        $inwave_input_allowed['input'] = array(
            'class' => array(),
            'id' => array(),
            'name' => array(),
            'value' => array(),
            'checked' => array(),
            'type' => array()
        );
        $inwave_input_allowed['select'] = array(
            'class' => array(),
            'id' => array(),
            'name' => array(),
            'value' => array(),
            'multiple' => array(),
            'type' => array()
        );
        $inwave_input_allowed['option'] = array(
            'value' => array(),
            'selected' => array()
        );
        return $inwave_input_allowed;
    }
}


if (!function_exists('inwave_get_post_views')) {

    function inwave_get_post_views($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }
}
if (!function_exists('inwave_social_sharing_fb')) {

    /**
     *
     * @global type $inwave_smof_data
     * @param String $link Link to share
     * @param String $text the text content to share
     * @param String $title the title to share
     * @param String $tag the wrap html tag
     */
    function inwave_social_sharing_fb($link, $text, $title)
    {
        $newWindow = 'onclick="return iwOpenWindow(this.href);"';
        $title = urlencode($title);
        $text = urlencode($text);
        $link = urlencode($link);
        $shareLink = 'https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . $title . '&amp;p[url]=' . $link . '&amp;p[summary]=' . $text.'&amp;u='. $link;
        echo '<a class="share-buttons-fb" target="_blank" href="#" title="' . esc_attr_x('Share on Facebook','title', 'incharity') . '" onclick="return iwOpenWindow(\'' . esc_js($shareLink) . '\')"><i class="fa fa-share"></i><span>share</span></a>';
    }


}