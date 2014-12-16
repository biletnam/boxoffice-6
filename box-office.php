<?php
/*
*
* Plugin Name: Box Office  	
* Plugin URI: http://hattmarris.com/
* Description: Easily manage a complete box office within WordPress
* Version: 1.0.0
* Author: Matt Harris
* Author URI: http://www.hattmarris.com
* Text Domain: boxoffice 
* License: GPL2

------------------------------------------------------------------------
Copyright 2014 Matt Harris

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

defined('ABSPATH') or die("No script kiddies please!");

//------------------------------------------------------------------------------------------------------------------
//---------- Box Office License Key -----------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
//If you hardcode a License Key here, it will automatically populate on activation.
$bo_license_key = "";

//-- OR ---//

//You can also add the Box Office license key to your wp-config.php file to automatically populate on activation
//Add the code in the comment below to your wp-config.php to do so:
//define('BO_LICENSE_KEY','YOUR_KEY_GOES_HERE');
//------------------------------------------------------------------------------------------------------------------

if(!defined("ABSPATH")){
    die();
}

if(!defined("BO_CURRENT_PAGE"))
    define("BO_CURRENT_PAGE", basename($_SERVER['PHP_SELF']));

if(!defined("IS_ADMIN")){
    define("IS_ADMIN",  is_admin());
}

//require_once files here

class BOffice {
	
	public static $version = '1.0.0';
	
	public function __construct() {
		add_action( 'init', array($this, 'bo_tickets_register_post_type') );
		add_action( 'admin_head', array($this, 'add_menu_icons_styles') );
        }
	
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
	
}

$BOffice = new BOffice(); 

?>
