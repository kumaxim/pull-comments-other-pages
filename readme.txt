=== Pull Comments From Other Page(s) ===
Contributors: kmaxim
Tags: comments
Requires PHP: 7.3
Requires at least: 5.4
Tested up to: 6.0
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Pull Comments From Other Page(s) allow you to pull comments from one or several pages and merge them among comments of target one.

== Description ==

Pull Comments From Other Page(s) is plugin that allow you to pull comments from one or several pages and merge them among comments of target one. Resulting list will be sort in chronological order.

Support both buildin (page, post) and any custom post type as source(s) and target page.

Pay attention that custom post type must support 'comments' feature.

== Frequently Asked Questions ==

= Comments was not displayed =

There are several reasons:

- Switch to page edit screen in admin panel. Verify that checkbox 'Allow comments' in panel 'Discussion' are selected.
- Deactivate plugin [Disable Comments](https://wordpress.org/plugins/disable-comments/) or allow in their options at least at one post type
- Verify that your theme support comments output. See function [wp_list_comments()](https://developer.wordpress.org/reference/functions/wp_list_comments/)

= Comments not merged in "WordPress => Admin Panel => Comments" =

They should not. The plugin do not perform any database changes. All comments from source pages still associated with original pages.
The plugin just retrieve them and merge with comments of target page. Even more, your users may still post comments on source(s) page and their will be appeared on target one automatically.
On other side, your users may still post comments on target page and their will be merged with comments of source(s) one for displaying on target.

== Screenshots ==

1. Dropdown open on edit page screen
2. Sources selected on edit page screen
3. Merged comments list on front-end

== Changelog ==

= 1.0.1 =
* Fix language's text domain PATH

= 1.0.0 =
* The 1st stable release of the plugin