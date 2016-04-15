=== Plugin Name ===
Contributors: circlecube
Donate link: http://circlecube.com/contact/
Tags: admin, toolbar, shortcuts
Requires at least: 3.3
Tested up to: 4.3
Stable tag: 0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add shortcut links to the admin toolbar to the index pages listing all content types.

== Description ==

Add shortcut links to the admin toolbar to the index pages listing all content types and other helpful locations you may find yourself constantly navigating to. This plugin brings these links one click closer. It will link to the index or list pages in the WordPress backend for posts, pages, all custom post types as well as the widgets page, the menu page and the users page. 

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= What's the point? =

I found myself constantly clicking to the wordpress dashboard in order to access the links to the pages I needed.


== Screenshots ==

1. Showing immediately after the plugin is activated. There is now a toolbar link with dropdown to all the content type content. Note the 'Field Group' CPT.
2. Showing many more cutom post types that are supported. The top level link still links to edit the current page/content you are viewing.
3. The top level link shown to edit the Custom Post Type of 'Testimonial'.

== Changelog ==

= 0.9 =
* Update gravity forms reference: using 'class_exists' rather than 'is_plugin_active'

= 0.8 =
* Compatability testing for 4.0
* Removed extraneous wp_reset_postdata that resulted in wrong links on certain templates with nested loops.

= 0.7 =
* Compatability testing for up to 3.9.1

= 0.6 =
* Add links for settings and plugins
* Add link for Gravity Forms (if installed)
* Add link for WPEngine (if installed)

= 0.5 =
* Replaces the built in Edit link in the toolbar. Now the dropdown is beneath that link to keep the toolbar less cluttered.

= 0.4 =
* Adding link to users page.

= 0.3 =
* Adding support for any custom post types.

= 0.2 =
* Adding links to the widget and menu pages.

= 0.1 =
* Initial version. Adding links to the toolbar for posts and pages.

== Upgrade Notice ==

= 0.5 =
* Combine with (replace) the built in Edit link in the toolbar. Now the dropdown is beneath that link to keep the toolbar less cluttered.