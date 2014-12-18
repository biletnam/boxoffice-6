<?php
/**
 * Main Plugin Class
 *
 * This class is the main class for the plugin.
 * This is where all core components will be hooked.
 *
 * @package Box Office
 * @since 2.0.0
 * @author Matt Harris <mattharris89@gmail.com>
 */
 
class BOffice {
	
	public static $version = '1.0.0';
	
	public function __construct() {
		add_action( 'init', array($this, 'bo_tickets_register_post_type') );
		add_action( 'admin_head', array($this, 'add_menu_icons_styles') );
		//add_action( 'template_redirect', array( $this, 'single_template' ) );
        }
        
        
        /**
	 * Register ticket custom post type
	 *
	 * This post type is the core of the plugin as tickets
	 * are handeled as a custom post type.
	 */
	public static function bo_tickets_register_post_type() {
		
		$labels = array(
			'name'               => _x( 'Tickets', 'post type general name', 'boxoffice' ),
			'singular_name'      => _x( 'Ticket', 'post type singular name', 'boxoffice' ),
			'menu_name'          => _x( 'Tickets', 'admin menu', 'boxoffice' ),
			'name_admin_bar'     => _x( 'Ticket', 'add new on admin bar', 'boxoffice' ),
			'add_new'            => _x( 'Add New', 'ticket', 'boxoffice' ),
			'add_new_item'       => __( 'Add New Ticket', 'boxoffice' ),
			'new_item'           => __( 'New Ticket', 'boxoffice' ),
			'edit_item'          => __( 'Edit Ticket', 'boxoffice' ),
			'view_item'          => __( 'View Ticket', 'boxoffice' ),
			'all_items'          => __( 'All Tickets', 'boxoffice' ),
			'search_items'       => __( 'Search Tickets', 'boxoffice' ),
			'parent_item_colon'  => __( 'Parent Tickets:', 'boxoffice' ),
			'not_found'          => __( 'No tickets found.', 'boxoffice' ),
			'not_found_in_trash' => __( 'No tickets found in Trash.', 'boxoffice' )
		);
		
		$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'ticket' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'menu_icon'          => '',
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
			);

		
		$post_type = 'ticket';
		
		register_post_type( $post_type, $args );	
	}
	
	public static function add_menu_icons_styles(){
	?>
		<style>
		#adminmenu .menu-icon-ticket div.wp-menu-image:before {
		  content: "\f323";
		}
		</style>
	<?php
	}
	
	/**
	 * Get the single ticket template for front-end
	 */
	public function single_template() {

		global $post;
		include( BO_PATH . '/templates/single-tickets.php' );
		exit();
		

	}
	
}

$BO = new BOffice();

?>