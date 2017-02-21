<?php
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	/**
	 * Plugin Name: Sadbhaw Donors
	 * Description: Plugin to manage donators for Sadbhaw
	 * Version: 1.0
	 * Author: Sadbhaw
	 */
	define('SADBHAW_PLUGIN_DIR',plugin_dir_path(__FILE__));
	require_once( SADBHAW_PLUGIN_DIR . 'sadbhaw-donators.php' );
	require_once( SADBHAW_PLUGIN_DIR . 'sadbhaw-volunteers.php' );
	require_once( SADBHAW_PLUGIN_DIR . 'sadbhaw-ambassadors.php' );
	require_once( SADBHAW_PLUGIN_DIR . 'sadbhaw-partners.php' );
	class Sadbhaw_Plugin {
		// class instance
		static $instance;
		// donator WP_List_Table object
		public $donator_obj;
		// volunteer WP_List_Table object
		public $volunteer_obj;
		// ambassador WP_List_Table object
		public $ambassador_obj;
		// partners WP_List_Table object
		public $partner_obj;
		// class constructor

		public function __construct() {
			add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
			add_action( 'admin_menu', [ $this, 'plugin_menu' ] );
		}

		public static function set_screen( $status, $option, $value ) {
			return $value;
		}

		public function plugin_menu() {
			$donator_hook = add_menu_page('Sadbhaw Donor','Sadbhaw Donor','manage_options','sadbhaw_donors',[ $this, 'donator_list_page' ]);
			$volunteer_hook = add_submenu_page('sadbhaw_donors','Sadbhaw Volunteers','Sadbhaw Volunteers','manage_options','sadbhaw_volunteers',[ $this, 'volunteer_list_page' ]);
			$ambassador_hook = add_submenu_page('sadbhaw_donors','Sadbhaw Ambassadors','Sadbhaw Ambassadors','manage_options','sadbhaw_ambassadors',[ $this, 'ambassador_list_page' ]);
			$partner_hook = add_submenu_page('sadbhaw_donors','Sadbhaw Partners','Sadbhaw Partners','manage_options','sadbhaw_partners',[ $this, 'partner_list_page' ]);
			add_action( "load-$donator_hook", [ $this, 'donator_screen_option' ] );
			add_action( "load-$volunteer_hook", [ $this, 'volunteer_screen_option' ] );
			add_action( "load-$ambassador_hook", [ $this, 'ambassador_screen_option' ] );
			add_action( "load-$partner_hook", [ $this, 'partner_screen_option' ] );
		}

		/**
		* Donator Screen options
		*/
		public function donator_screen_option() {
			$option = 'per_page';
			$args   = [
				'label'   => 'Donors',
				'default' => 10,
				'option'  => 'donators_per_page'
			];
			add_screen_option( $option, $args );
			$this->donator_obj = new Sadbhaw_Donators_List();
		}

		/**
		* Donator Screen options
		*/
		public function volunteer_screen_option() {
			$option = 'per_page';
			$args   = [
				'label'   => 'Volunteers',
				'default' => 10,
				'option'  => 'volunteers_per_page'
			];
			add_screen_option( $option, $args );
			$this->volunteer_obj = new Sadbhaw_Volunteers_List();
		}

		/**
		* Ambassador Screen options
		*/
		public function ambassador_screen_option() {
			$option = 'per_page';
			$args   = [
				'label'   => 'Ambassadors',
				'default' => 10,
				'option'  => 'ambassadors_per_page'
			];
			add_screen_option( $option, $args );
			$this->ambassador_obj = new Sadbhaw_Ambassadors_List();
		}

		/**
		* Partner Screen options
		*/
		public function partner_screen_option() {
			$option = 'per_page';
			$args   = [
				'label'   => 'Partners',
				'default' => 10,
				'option'  => 'partners_per_page'
			];
			add_screen_option( $option, $args );
			$this->partner_obj = new Sadbhaw_Partners_List();
		}

		/**
		* Donator list page
		*/
		public function donator_list_page() {
			?>
			<div class="wrap">
				<h2>Sadbhaw Donors</h2>
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-12">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form id="donator_form" method="post">
									<?php
									$this->donator_obj->prepare_items();
									$this->donator_obj->display(); ?>
								</form>
							</div>
						</div>
					</div>
					<br class="clear">
				</div>
			</div>
		<?php
		}

		/**
		* Volunteer list page
		*/
		public function volunteer_list_page() {
			?>
			<div class="wrap">
				<h2>Sadbhaw Volunteers</h2>
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-12">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form id="volunteer_form" method="post" >
									<?php
									$this->volunteer_obj->prepare_items();
									$this->volunteer_obj->display(); ?>
								</form>
							</div>
						</div>
					</div>
					<br class="clear">
				</div>
			</div>
		<?php
		}

		/**
		* Ambassador list page
		*/
		public function ambassador_list_page() {
			?>
			<div class="wrap">
				<h2>Sadbhaw Ambassadors</h2>
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-12">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form id="ambassador_form" method="post" >
									<?php
									$this->ambassador_obj->prepare_items();
									$this->ambassador_obj->display(); ?>
								</form>
							</div>
						</div>
					</div>
					<br class="clear">
				</div>
			</div>
		<?php
		}

		/**
		* Partner list page
		*/
		public function partner_list_page() {
			?>
			<div class="wrap">
				<h2>Sadbhaw Partners</h2>
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-12">
						<div id="post-body-content">
							<div class="meta-box-sortables ui-sortable">
								<form id="partner_form" method="post" >
									<?php
									$this->partner_obj->prepare_items();
									$this->partner_obj->display(); ?>
								</form>
							</div>
						</div>
					</div>
					<br class="clear">
				</div>
			</div>
		<?php
		}

		/** Singleton instance */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

	}
	add_action( 'plugins_loaded', function () {
		Sadbhaw_Plugin::get_instance();
	} );