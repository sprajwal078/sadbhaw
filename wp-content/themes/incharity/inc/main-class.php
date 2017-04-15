<?php
/**
 * Created by PhpStorm.
 * User: HUNGTX
 * Date: 4/1/2015
 * Time: 4:44 PM
 */
class Inwave_Main
{
    function __construct()
    {
        global $inwave_smof_data;
        /* Include helper function */
        require get_template_directory() . '/inc/helper.php';

        /* require custom widgets */
        include_once(get_template_directory() . '/widgets/default.php');

        /* Metabox for post and page */
        include_once(get_template_directory() . '/metaboxes/metaboxes.php');

        /* Implement the woocommerce template. */
        require get_template_directory() . '/inc/woocommerce.php';

        /** Dynamic css color*/
		add_action('wp_ajax_inwave_color', array($this, 'color'));
        add_action('wp_ajax_nopriv_inwave_color', array($this, 'color'));
        add_action('inwave_of_save_options_after', array($this, 'color'));

        /** Initial widgets */
        add_action('widgets_init', array($this, 'widgets_init'));

        /* Load setting from cookie*/
        $this->load_panel_settings();
		
		/* add body class: support white color and boxed layout */
		add_filter( 'body_class',array($this,'inwave_add_body_class'));

        /** retina support */
        if(isset($inwave_smof_data['retina_support']) && $inwave_smof_data['retina_support']){
            add_filter( 'wp_generate_attachment_metadata', array($this,'retina_support_attachment_meta'), 10, 2 );
            add_filter( 'delete_attachment', array($this,'delete_retina_support_images'));
        }

        if ( is_admin() ) {
            /* INCLUDE IMPORT DEMO CONTENT */
            include_once(get_template_directory() . '/admin/importer/importer.php');

			add_action('admin_init', array($this, 'checkCreatedCustomCSS'));
			
            /**
             * Include the TGM_Plugin_Activation class.
             */
            require_once (get_template_directory() . '/admin/class-tgm-plugin-activation.php');
            add_action('tgmpa_register', array($this,'inwave_register_required_plugins'));
        }else{

            /* Append panel setting to footer*/
            if($inwave_smof_data['show_setting_panel']) {
                add_action('wp_footer', array($this, 'append_options'));
            }
        }
    }
	function inwave_add_body_class($classes){
		global $inwave_cfg,$inwave_smof_data;

		if($inwave_cfg['page-classes']){
			$classes[] = $inwave_cfg['page-classes'];
		}
		if($inwave_cfg['panel-settings']->layout=='boxed'){
			$classes[] = 'body-boxed';
		}

		return $classes;
	}
	public static function getConfig($type = ''){
		global $inwave_cfg,$inwave_smof_data;
		if($type == 'smof'){ 
			return $inwave_smof_data;
		}
		return $inwave_cfg;
	}
	public static function getAuthorData(){
		global $authordata;
		return $authordata;
	}
	public static function setConfig($config,$type =''){
		global $inwave_cfg,$inwave_smof_data;
		if($type == 'smof'){ 
			$inwave_smof_data = $config;
		}
		else{
			$inwave_cfg = $config;
		}
	}
    	
	function checkCreatedCustomCSS(){
		WP_Filesystem();
        global $wp_filesystem;
		if(!$wp_filesystem->exists($this->getCustomCssDir().'custom.css')){	
		
			$this->color();
		}
	}
	public static function getCustomCssDir(){
		$uploads = wp_upload_dir();
		return $uploads['basedir'] . '/incharity/';		
	}
	public static function getCustomCssUrl(){
		$uploads = wp_upload_dir();
		return $uploads['baseurl'] . '/incharity/';	
	}

    /* Load panel settings from cookie or default config */
    public static function load_panel_settings()
    {
        global $inwave_cfg, $inwave_smof_data;
		if(!is_array($inwave_cfg)){
			$inwave_cfg = array();
		}
        if(isset($inwave_smof_data['show_setting_panel'])) {
            if ($inwave_smof_data['show_setting_panel'] && isset($_COOKIE['incharity-setting']) && $_COOKIE['incharity-setting']) {
                $inwave_cfg['panel-settings'] = str_replace('\"', '"', $_COOKIE['incharity-setting']);
                $inwave_cfg['panel-settings'] = @json_decode($inwave_cfg['panel-settings']);
            } else {
                $inwave_cfg['panel-settings'] = new stdClass();
                $inwave_cfg['panel-settings']->layout = $inwave_smof_data['body_layout'];
                $inwave_cfg['panel-settings']->mainColor = $inwave_smof_data['primary_color'];
            }
            if(!isset($inwave_cfg['panel-settings']->bgColor)){
                $inwave_cfg['panel-settings']->bgColor = '';
            }
        }

    }

    /* Append panel setting to footer*/
    function append_options()
    {
        include_once(get_template_directory() . '/blocks/panel-settings.php');
    }

    /** return/echo css color and css configuration */
    function color()
    {
        WP_Filesystem();
        global $inwave_cfg,$wp_filesystem,$inwave_smof_data;
		
        // load settings again
		self::load_panel_settings();

        // Color & background for content
        $colorText = $wp_filesystem->get_contents(get_template_directory() . '/css/color.css');
        if ($inwave_cfg['panel-settings']->mainColor) {
            $colorText = str_replace('#ed9914', $inwave_cfg['panel-settings']->mainColor, $colorText);
        }

        // CSS configuration. Example: background color of header,footer
        $colorText .= $this->config_css();

        // Background for Body page
        if (isset($inwave_cfg['panel-settings']->bgColor)&& $inwave_cfg['panel-settings']->bgColor) {
            if ($inwave_cfg['panel-settings']->bgColor[0] == '#') {
                $colorText .= 'body.page{background:' . $inwave_cfg['panel-settings']->bgColor . '}';
            } else {
                $colorText .= 'body.page{background:url(' . $inwave_cfg['panel-settings']->bgColor . ')}';
            }
        }
		
        if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'inwave_color') {
			// Set header content-type
			header("Content-type: text/css; charset: UTF-8");
			echo wp_kses_normalize_entities($colorText); /** css text output for ajax*/
			exit;	
		}else{
			$iw_upload_url = self::getCustomCssDir();
			if ( ! $wp_filesystem->is_dir( $iw_upload_url ) ) {
				if ( ! $wp_filesystem->mkdir( $iw_upload_url, 0755 ) ) {
					return false;
				}
			}
			$wp_filesystem->put_contents($iw_upload_url.'custom.css',$colorText);

		}
    }

   
    /**
     * Register widget area.
     * @link http://codex.wordpress.org/Function_Reference/register_sidebar
     */
    public static function widgets_init()
    {
        register_sidebar(array(
            'name' => esc_html__('Sidebar Default', 'incharity'),
            'id' => 'sidebar-default',
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));
        register_sidebar(
            array(
                'name' => esc_html__('Sidebar Product Page', 'incharity'),
                'id' => 'sidebar-woocommerce',
                'description' => '',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h3 class="widget-title"><span>',
                'after_title' => '</span></h3>',
            ));
        register_sidebar(
            array(
                'name' => esc_html__('Sidebar FAQ', 'incharity'),
                'id' => 'sidebar-faq',
                'description' => '',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h3 class="widget-title"><span>',
                'after_title' => '</span></h3>',
            ));
        register_sidebar(
            array(
                'name' => esc_html__('Sidebar Footer Default', 'incharity'),
                'id' => 'sidebar-footer1',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="%2$s ' . self::count_widgets('sidebar-footer1') . '">',
                'after_widget' => '</div>',
                'before_title' => '<div class="footer-title"><h4>',
                'after_title' => '</h4></div>'
            ));
        register_sidebar(
            array(
                'name' => esc_html__('Sidebar Footer V2', 'incharity'),
                'id' => 'sidebar-footer-email',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="%2$s ' . self::count_widgets('sidebar-footer-email') . '">',
                'after_widget' => '</div>',
                'before_title' => '<div class="footer-title"><h4>',
                'after_title' => '</h4></div>'
            ));
    }

    /**
     * Count widgets function
     * https://gist.github.com/slobodan/6156076
     */
    public static function count_widgets($sidebar_id)
    {
        // If loading from front page, consult $_wp_sidebars_widgets rather than options
        // to see if wp_convert_widget_settings() has made manipulations in memory.
        global $_wp_sidebars_widgets;
        if (empty($_wp_sidebars_widgets)) :
            $_wp_sidebars_widgets = get_option('sidebars_widgets', array());
        endif;
        $sidebars_widgets_count = $_wp_sidebars_widgets;
        if (isset($sidebars_widgets_count[$sidebar_id])) :
            $widget_count = count($sidebars_widgets_count[$sidebar_id]);
            $widget_classes = 'widget-count-' . count($sidebars_widgets_count[$sidebar_id]);
            if ($widget_count >= 3) :
            // Four widgets er row if there are exactly four or more than 3
                $widget_classes .= ' col-md-4 col-sm-4';
            elseif ($widget_count == 2) :
            // Three widgets per row if there's three or more widgets
                $widget_classes .= ' col-md-6 col-sm-6';
            elseif ($widget_count == 1) :
            // Otherwise show two widgets per row
                $widget_classes .= ' col-md-12 col-sm-12';
            endif;
            $widget_classes .= ' col-xs-12';
            return $widget_classes;
        endif;
    }

    /**
     * Retina images
     *
     * This function is attached to the 'wp_generate_attachment_metadata' filter hook.
     */
    function retina_support_attachment_meta( $metadata, $attachment_id ) {
        foreach ( $metadata as $key => $value ) {
            if ( is_array( $value ) ) {
                foreach ( $value as $image => $attr ) {
                    if ( is_array( $attr ) )
                        $this->retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
                }
            }
        }
        return $metadata;
    }
    /**
     * Create retina-ready images
     *
     * Referenced via retina_support_attachment_meta().
     */
    function retina_support_create_images( $file, $width, $height, $crop = false ) {
        if ( $width || $height ) {
            $resized_file = wp_get_image_editor( $file );
            if ( ! is_wp_error( $resized_file ) ) {
                $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );

                $resized_file->resize( $width * 2, $height * 2, $crop );
                $resized_file->save( $filename );

                $info = $resized_file->get_size();

                return array(
                    'file' => wp_basename( $filename ),
                    'width' => $info['width'],
                    'height' => $info['height'],
                );
            }
        }
        return false;
    }
    /**
     * Delete retina-ready images
     *
     * This function is attached to the 'delete_attachment' filter hook.
     */
    function delete_retina_support_images( $attachment_id ) {
        $meta = wp_get_attachment_metadata( $attachment_id );
        $upload_dir = wp_upload_dir();
        $path = pathinfo( $meta['file'] );
        foreach ( $meta as $key => $value ) {
            if ( 'sizes' === $key ) {
                foreach ( $value as $sizes => $size ) {
                    $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
                    $retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
                    if ( file_exists( $retina_filename ) )
                        unlink( $retina_filename );
                }
            }
        }
    }

    function inwave_register_required_plugins() {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            array(
                'name'               => 'Visual Composer',
                'slug'               => 'js_composer',
                'source'             => get_template_directory() . '/admin/plugins/js_composer.zip',
                'required'           => true,
                'version'            => '4.12',
                'force_activation'   => false,
                'force_deactivation' => false,
				'copy_folder' => true,
                'external_url'       => '',
            ),
			array(
                'name'               => 'Visual Composer Addons',
                'slug'               => 'iw_composer_addons',
                'source'             => get_template_directory() . '/admin/plugins/iw_composer_addons.zip',
                'required'           => true,
                'version'            => '1.1.3',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
			array(
                'name'               => 'Crowdfunding',
                'slug'               => 'infunding',
                'source'             => get_template_directory() . '/admin/plugins/infunding.zip',
                'required'           => false,
                'version'            => '1.3.0',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'               => 'Revolution Slider',
                'slug'               => 'revslider',
                'source'             => get_template_directory() . '/admin/plugins/revslider.zip',
                'required'           => false,
                'version'            => '5.2.5.3',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
			array(
                'name'      => 'Contact Form 7',
                'slug'      => 'contact-form-7',
                'required'  => false,
            ),
			array(
                'name'      => 'Woocommerce',
                'slug'      => 'woocommerce',
                'required'  => false,
            ),
            array(
                'name'      => 'YITH Woocommerce Wishlist',
                'slug'      => 'yith-woocommerce-wishlist',
                'required'  => false,
            )
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => esc_html__( 'Install Required Plugins', 'tgmpa' ),
                'menu_title'                      => esc_html__( 'Install Plugins', 'tgmpa' ),
                'installing'                      => esc_html__( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
                'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tgmpa' ),
                'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
                'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tgmpa' ),
                'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tgmpa' ),
                'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa( $plugins, $config );

    }

    /**
     * LOAD CSS FROM CONFIGURATION
     */
    function config_css(){
        global $inwave_smof_data,$inwave_cfg;
        $css = '';
		
        //font
        if($inwave_smof_data['gf_body']){
            $css .= 'html body{font-family:'.$inwave_smof_data['gf_body'].'}';
        }
        if($inwave_smof_data['gf_nav']){
            $css .= '.nav-menu{font-family:'.$inwave_smof_data['gf_nav'].'}';
        }
        if($inwave_smof_data['f_headings']){
            $css .= 'h1,h2,h3,h4,h5,h6{font-family:'.$inwave_smof_data['f_headings'].'}';
        }
        if($inwave_smof_data['f_size']){
            $css .= 'html body{font-size:'.$inwave_smof_data['f_size'].'px}';
        }
        if($inwave_smof_data['f_lineheight']){
            $css .= 'html body{line-height:'.$inwave_smof_data['f_lineheight'].'px}';
        }


        //body background
        if($inwave_smof_data['body_layout']) {
            if ($inwave_smof_data['bg_color']) {
                if ($inwave_smof_data['bg_image']) {
                    $css .= 'body.page{background-color:' . $inwave_smof_data['bg_color'] . '}';
                } else {
                    $css .= 'body.page{background:' . $inwave_smof_data['bg_color'] . '}';
                }
            }

            if ($inwave_smof_data['bg_image']) {
                $css .= 'body.page{background-image:url(' . $inwave_smof_data['bg_image'] . ')';
                if ($inwave_smof_data['bg_full']) {
                    $css .= 'background-size:100%';
                }
                if ($inwave_smof_data['bg_repeat']) {
                    $css .= 'background-repeat:' . $inwave_smof_data['bg_repeat'] . ';';
                }
                $css .= '}';
            }
        }
        //header bg
        if($inwave_smof_data['header_bg_color']){
            $css .= '.header{background-color:'.$inwave_smof_data['header_bg_color'].'!important}';
        }
        if($inwave_smof_data['header_top_bg_color']){
            $css .= '.header-top{background-color:'.$inwave_smof_data['header_top_bg_color'].'!important}';
        }
        if($inwave_smof_data['header_bd_color']){
            $css .= '.header,.header-top{border-color:'.$inwave_smof_data['header_bd_color'].'!important}';
        }
        //content bg
        if($inwave_smof_data['content_bg_color']){
            $css .= '.contents-main{background-color:'.$inwave_smof_data['content_bg_color'].'!important}';
        }
        //footer bg
        if($inwave_smof_data['footer_bg_color']){
            $css .= '.page-footer,.footer-right, .page-footer .container{background:'.$inwave_smof_data['footer_bg_color'].'!important}';
        }
        if($inwave_smof_data['footer_border_color']){
            $css .= '.page-footer{border-color:'.$inwave_smof_data['footer_border_color'].'!important}';
        }
        if($inwave_smof_data['footer_bg_btt']){
            $css .= '.copyright{background-color:'.$inwave_smof_data['footer_bg_btt'].'!important}';
        }

        //body color
        if($inwave_smof_data['body_text_color']){
            $css .= 'html body{color:'.$inwave_smof_data['body_text_color'].'}';
        }
        if($inwave_smof_data['link_color']){
            $css .= 'a{color:'.$inwave_smof_data['link_color'].'}';
        }
        //header color
        if($inwave_smof_data['header_text_color']){
            $css .= '.header{color:'.$inwave_smof_data['header_text_color'].'}';
        }
        if($inwave_smof_data['header_link_color']){
            $css .= '.header a{color:'.$inwave_smof_data['header_link_color'].'}';
        }

        if($inwave_smof_data['button_text_color']){
            $css .= '#page-top .button,#page-top .btn-submit{color:'.$inwave_smof_data['button_text_color'].'}';
        }
        if($inwave_smof_data['page_title_color']){
            $css .= '.page-title h1{color:'.$inwave_smof_data['page_title_color'].'}';
        }

        if($inwave_smof_data['blockquote_color']){
            $css .= '.contents-main blockquote{color:'.$inwave_smof_data['blockquote_color'].'}';
        }
        if($inwave_smof_data['footer_headings_color']){
            $css .= '.page-footer h3,.page-footer h4{color:'.$inwave_smof_data['footer_headings_color'].'}';
        }
        if($inwave_smof_data['footer_text_color']){
            $css .= '.page-footer{color:'.$inwave_smof_data['footer_text_color'].'}';
        }
        if($inwave_smof_data['footer_link_color']){
            $css .= '.page-footer a{color:'.$inwave_smof_data['footer_link_color'].'}';
        }

        // header bg image
        if($inwave_smof_data['header_bg_image']){
            $css .= '.header{background-image:url('.$inwave_smof_data['header_bg_image'].')!important;';
            if($inwave_smof_data['header_bg_full']){
                $css.='background-size:100%;';
            }
            if($inwave_smof_data['header_bg_repeat']){
                $css.='background-repeat:'.$inwave_smof_data['header_bg_repeat'].';';
            }
            $css .= '}';
        }
        if($inwave_smof_data['page_title_height']){
			$paddingTop = floor(intval($inwave_smof_data['page_title_height'])/2);
			if(intval($inwave_smof_data['page_title_height']) < 250){
				$css .='.wrapper .page-heading{height:'.$inwave_smof_data['page_title_height'].'!important;}.page-heading .iw-heading-title{padding-top:'.$paddingTop.'px;!important}';
			}else{
				$css .='.page-heading{height:'.$inwave_smof_data['page_title_height'].';}.page-heading .iw-heading-title{padding-top:'.$paddingTop.'px;}';
			}
			
        }
        if($inwave_smof_data['page_title_bg']){
            $css .= '.page-heading{background-image:url('.$inwave_smof_data['page_title_bg'].')!important;';
            if($inwave_smof_data['page_title_bg_full']){
                $css.='background-size:100%;';
            }
            if($inwave_smof_data['page_title_bg_repeat']){
                $css.='background-repeat:'.$inwave_smof_data['page_title_bg_repeat'].';';
            }
            $css .= '}';
        }

        //footer widget
        if($inwave_smof_data['footer_bg_image']){
            $css .= '.page-footer{background-image:url('.$inwave_smof_data['footer_bg_image'].')!important;';
            if($inwave_smof_data['footer_bg_full']){
                $css.='background-size:100%';
            }
            if($inwave_smof_data['footer_bg_repeat']){
                $css.='background-repeat:'.$inwave_smof_data['page_title_bg_repeat'].';';
            }
            $css .= '}';
			$css .= '.footer-right, .page-footer .container{background:none!important;}';
        }

        return $css;
    }

}
new Inwave_Main();