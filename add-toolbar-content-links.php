<?php
/*
Plugin Name: Add Toolbar Content Links
Plugin URI: http://circlecube.com
Description: Add shortcut links to the admin toolbar to the index pages listing all content types.
Version: 0.6
Author: Evan Mullins
Author Email: evan@circlecube.com
License:

  Copyright 2011 Evan Mullins (evan@circlecube.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

class AddToolbarContentLinks {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Add Toolbar Content Links';
	const slug = 'add_toolbar_content_links';
	
	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
		register_activation_hook( __FILE__, array( &$this, 'install_add_toolbar_content_links' ) );

		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_add_toolbar_content_links' ) );
		add_action('admin_bar_menu', array( $this, 'custom_toolbar_link'), 999); 
	}
  
	/**
	 * Runs when the plugin is activated
	 */  
	function install_add_toolbar_content_links() {
		// do not generate any output here
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	function init_add_toolbar_content_links() {
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();

	
		if ( is_admin() ) {
			//this will run when in the WordPress admin
		} else {
			//this will run when on the frontend
		}

		/*
		 * TODO: Define custom functionality for your plugin here
		 *
		 * For more information: 
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_action( 'your_action_here', array( &$this, 'action_callback_method_name' ) );
		add_filter( 'your_filter_here', array( &$this, 'filter_callback_method_name' ) ); 
		 
	}

	function action_callback_method_name() {
		// TODO define your action method here 
	}

	function filter_callback_method_name() {
		// TODO define your filter method here
	}

	function custom_toolbar_link($wp_admin_bar) {
		$current_user_can = current_user_can( 'install_plugins' );

		if ($current_user_can) {
			wp_reset_postdata();
			$current_post_type = get_post_type_object( get_post_type() );

			$args = array(
				'id' => 'edit',
				'title' => 'Edit ' . $current_post_type->labels->singular_name, 
				'href' => get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit', 
				'meta' => array(
					'class' => 'content', 
					)
			);
			$wp_admin_bar->add_node($args);

			$args = array(
				'id' => 'edit-posts',
				'title' => 'Edit Posts', 
				'href' => get_admin_url() . 'edit.php', 
				'parent' => 'edit', 
				'meta' => array(
					'class' => 'edit-posts', 
					)
			);
			$wp_admin_bar->add_node($args);

			$args = array(
				'id' => 'edit-pages',
				'title' => 'Edit Pages', 
				'href' => get_admin_url() . 'edit.php?post_type=page', 
				'parent' => 'edit', 
				'meta' => array(
					'class' => 'edit-pages', 
					)
			);
			$wp_admin_bar->add_node($args);

			$args = array(
			   // 'public'   => true,
			   '_builtin' => false
			);
			$pts = get_post_types($args, 'objects');

			foreach($pts as $pt) {
				$args = array(
					'id' => 'edit-' . $pt->name,
					'title' => 'Edit ' . $pt->label, 
					'href' => get_admin_url() . 'edit.php?post_type=' . $pt->name,
					'parent' => 'edit', 
					'meta' => array(
						'class' => 'edit-' . $pt->name
						)
				);
				$wp_admin_bar->add_node($args);
			}

			if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {

				$args = array(
					'id' => 'gforms',
					'title' => 'Edit Forms', 
					'href' => get_admin_url() . 'admin.php?page=gf_edit_forms', 
					'parent' => 'edit', 
					'meta' => array(
						'class' => 'edit-forms'
						)
				);
				$wp_admin_bar->add_node($args);

			}

			$args = array(
				'id' => 'edit-widgets',
				'title' => 'Edit Widgets', 
				'href' => get_admin_url() . 'widgets.php', 
				'parent' => 'edit', 
				'meta' => array(
					'class' => 'edit-widgets', 
					)
			);
			$wp_admin_bar->add_node($args);

			$args = array(
				'id' => 'edit-menus',
				'title' => 'Edit Menus', 
				'href' => get_admin_url() . 'nav-menus.php', 
				'parent' => 'edit', 
				'meta' => array(
					'class' => 'edit-menus', 
					)
			);
			$wp_admin_bar->add_node($args);

			$args = array(
				'id' => 'edit-users',
				'title' => 'Edit Users', 
				'href' => get_admin_url() . 'users.php', 
				'parent' => 'edit', 
				'meta' => array(
					'class' => 'edit-users'
					)
			);
			$wp_admin_bar->add_node($args);

			$args = array(
				'id' => 'plugins',
				'title' => 'Plugins', 
				'href' => get_admin_url() . 'plugins.php', 
				'parent' => 'edit', 
				'meta' => array(
					'class' => 'edit-plugins'
					)
			);
			$wp_admin_bar->add_node($args);

			$args = array(
				'id' => 'settings',
				'title' => 'Settings', 
				'href' => get_admin_url() . 'options-general.php', 
				'parent' => 'edit', 
				'meta' => array(
					'class' => 'edit-settings'
					)
			);
			$wp_admin_bar->add_node($args);

			if ( class_exists('WpeCommon') ) {

				$args = array(
					'id' => 'wp-wpengine',
					'title' => 'WPEngine', 
					'href' => get_admin_url() . 'admin.php?page=wpengine-common', 
					'parent' => 'edit', 
					'meta' => array(
						'class' => 'wp-wpengine'
						)
				);
				$wp_admin_bar->add_node($args);

			}
		}
		//else nothing
	}


  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			$this->load_file( self::slug . '-admin-script', '/js/admin.js', true );
			$this->load_file( self::slug . '-admin-style', '/css/admin.css' );
		} else {

		} // end if/else
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file
  
} // end class
new AddToolbarContentLinks();

?>