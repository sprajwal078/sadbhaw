<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}
	//Table showing partners list
	class Sadbhaw_Partners_List extends WP_List_Table {
		/** Class constructor */
		public function __construct() {
			parent::__construct( [
				'singular' => __( 'Partner', 'sadbhaw' ), //singular name of the listed records
				'plural'   => __( 'Partners', 'sadbhaw' ) //plural name of the listed records
			] );
		}

		/**
		 * Retrieve partners’s data from the database
		 *
		 * @param int $per_page
		 * @param int $page_number
		 *
		 * @return mixed
		 */
		public static function get_partners( $per_page = 10, $page_number = 1 ) {
		  global $wpdb;
		  $sql = "SELECT ID,name,email,address FROM {$wpdb->prefix}sadbhaw_partners";
		  if ( ! empty( $_REQUEST['orderby'] ) ) {
		    $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
		    $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		  }
  	  $sql .= " LIMIT $per_page";
  	  $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
  	  $result = $wpdb->get_results( $sql, 'ARRAY_A' );
		  return $result;
		}

		/**
		 * Delete an partner record.
		 *
		 * @param int $id customer ID
		 */
		public static function delete_partner( $id ) {
		  global $wpdb;
		  $wpdb->delete(
		    "{$wpdb->prefix}sadbhaw_partners",
		    [ 'ID' => $id ],
		    [ '%d' ]
		  );
		}

		/** Text displayed when no partner data is available */
		public function no_items() {
		  _e( 'No partners avaliable.' );
		}

			/**
		 *  Associative array of columns
		 *
		 * @return array
		 */
		function get_columns() {
		  $columns = [
		  	'cb'      => '<input type="checkbox" />',
		    'name'    => __( 'Name','sadbhaw' ),
		    'email' => __( 'Email','sadbhaw' ),
		    'address'    => __( 'Address','sadbhaw' )
		  ];
		  return $columns;
		}

		/**
		 * Handles data query and filter, sorting, and pagination.
		 */
		public function prepare_items() {
			$columns = $this->get_columns();
		  $hidden = array();
		  $sortable = array();
		  $this->_column_headers = array($columns, $hidden, $sortable);
		  /** Process bulk action */
  		$this->process_bulk_action();
		  $per_page     = $this->get_items_per_page( 'partners_per_page', 10 );
		  $current_page = $this->get_pagenum();
		  $items = self::get_partners( $per_page, $current_page );
		  $total_items  = count($items);
		  $this->set_pagination_args( [
		    'total_items' => $total_items, //WE have to calculate the total number of items
		    'per_page'    => $per_page //WE have to determine how many items to show on a page
		  ] );
		  $this->items = $items;
		}


			/**
		 * Render a column when no column specific method exist.
		 *
		 * @param array $item
		 * @param string $column_name
		 *
		 * @return mixed
		 */
			public function column_default( $item, $column_name ) {
				global $wpdb;
				switch ( $column_name ) {
					case 'name':
					case 'email':
					case 'address':
						return $item[ $column_name ];
					default:
						//return print_r( $item, true ); //Show the whole array for troubleshooting purposes
				}
			}

			/**
		 * Render the bulk edit checkbox
		 *
		 * @param array $item
		 *
		 * @return string
		 */
		function column_cb( $item ) {
		  return sprintf(
		    '<input type="checkbox" name="bulk-delete[]" value="%d" />', $item['ID']
		  );
		}


		/**
		 * Returns an associative array containing the bulk action
		 *
		 * @return array
		 */
		public function get_bulk_actions() {
		  $actions = [
		    'bulk-delete' => 'Delete'
		  ];
		  return $actions;
		}

		public function process_bulk_action() {
		  //Detect when a bulk action is being triggered...
		  if ( 'delete' === $this->current_action() ) {
		    // In our file that handles the request, verify the nonce.
		    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
		    if ( ! wp_verify_nonce( $nonce, 'sadbhaw_delete_partner' ) ) {
		      die( 'Go get a life script kiddies' );
		    }
		    else {
		      self::delete_partner( absint( $_GET['partner'] ) );
		      wp_redirect( esc_url( add_query_arg() ) );
		      exit;
		    }
		  }
		  // If the delete bulk action is triggered
		  if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
		       || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
		  ) {
		    $delete_ids = esc_sql( $_POST['bulk-delete'] );
		    // loop over the array of record IDs and delete them
		    foreach ( $delete_ids as $id ) {
		      self::delete_partner( $id );
		    }
		  }
		}

	}