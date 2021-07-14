<?php
/**
 * Plugin Name:       Admin Toolbar Content Links
 * Plugin URI:        https://github.com/circlecube/add-toolbar-content-links
 * Description:       Add shortcut links to the admin toolbar to the index pages listing all content types. Save clicks = save time.
 * Version:           1.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Evan Mullins
 * Author URI:        https://circlecube.com
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

/*

  Copyright 2021 Evan Mullins (evan@circlecube.com)

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
	
	/**
	 * Constructor
	 */
	function __construct() {
		//Hook up to the admin_bar_menu action
		add_action('admin_bar_menu', array( $this, 'custom_toolbar_link'), 999); 
	}

	function custom_toolbar_link($wp_admin_bar) {
		$current_user_can = current_user_can( 'install_plugins' );

		if ($current_user_can) {
			$current_post_type = get_post_type_object( get_post_type() );

			$current_post_type_single_label = 'Posts';
			$current_post_id = '';
			if ( $current_post_type ) {
				$current_post_type_single_label = $current_post_type->labels->singular_name;
				$current_post_id = get_the_ID();
			}

			$args = array(
				'id' => 'edit',
				'title' => 'Edit ' . $current_post_type_single_label, 
				'href' => get_admin_url() . 'post.php?post=' . $current_post_id . '&action=edit', 
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
				if ( $pt->name != 'acf-field') { //exclude the field type of ACF
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
			}

			if ( class_exists('GFForms') ) {

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

			if ( class_exists('WPMDB_Base') ) {

				$args = array(
					'id' => 'wp-migrate-db',
					'title' => 'WP Migrate DB', 
					'href' => get_admin_url() . 'tools.php?page=wp-migrate-db-pro', 
					'parent' => 'edit', 
					'meta' => array(
						'class' => 'wp-mdb'
						)
				);
				$wp_admin_bar->add_node($args);
			}

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

} // end class
new AddToolbarContentLinks();

?>
