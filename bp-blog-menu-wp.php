<?php
/**
 * Plugin Name: BP Blog menu for Wordpress
 * Plugin URI: http://buddydev.com/plugins/bp-blog-menu-for-wp
 * Author: Brajesh Singh
 * Author URI: http://buddydev.com/members/sbrajesh
 * Description: Enable the Wordpress Multisite aStyle Blog menu for BuddyPress on Single User Wordpress
 * Version: 1.0
 * last Updated:25th october 2010
 * License: GPL
 * 
 */

add_action( 'bp_adminbar_menus', 'bp_adminbar_blogs_menu_single_wp', 6 );
function bp_adminbar_blogs_menu_single_wp() {
	global $bp;

	if ( !is_user_logged_in()||!current_user_can("publish_posts") )//show this menu to author, not to the the contributor & subscriber
		return false;

        $blog =bpdev_get_single_wp_blog_info();


	echo '<li id="bp-adminbar-blogs-menu"><a href="' . $bp->root_domain .'/wp-admin/">';

	_e( 'Blog Admin', 'bbmw' );

	echo '</a>';
	echo '<ul>';



		if ( !empty( $blog) ) {
			$alt = ' class="alt"';
			$site_url = esc_attr( $blog->siteurl );

			echo '<li' . $alt . '>';

			echo '<li class="alt"><a href="' . $site_url . 'wp-admin/">' . __( 'Dashboard', 'bbmw' ) . '</a></li>';
                        if(current_user_can("publish_posts"))
                                echo '<li><a href="' . $site_url . 'wp-admin/post-new.php">' . __( 'New Post', 'bbmw' ) . '</a></li>';
			
                       if(current_user_can("edit_posts"))
                                echo '<li class="alt"><a href="' . $site_url . 'wp-admin/edit.php">' . __( 'Manage Posts', 'bbmw' ) . '</a></li>';
                       if(current_user_can("moderate_comments"))
                                echo '<li><a href="' . $site_url . 'wp-admin/edit-comments.php">' . __( 'Manage Comments', 'bbmw' ) . '</a></li>';
                       if(current_user_can("activate_plugins"))
                                echo '<li><a href="' . $site_url . 'wp-admin/plugins.php">' . __( 'Manage Plugins', 'bbmw' ) . '</a></li>';
                       if(current_user_can("list_users"))
                                echo '<li><a href="' . $site_url . 'wp-admin/users.php">' . __( 'Manage Users', 'bbmw' ) . '</a></li>';


		}


	echo '</ul>';
	echo '</li>';
}
//create dummy blog object, we can even avoid it too, as we only need site_url and nothing else
function bpdev_get_single_wp_blog_info(){
    global $bp;
    $blog=new stdClass();
    $blog->siteurl=$bp->root_domain."/";
    $blog->name=get_bloginfo('name');
    return $blog;
}

/** allow admins to show this menu to the autor/editor/contributor*/




?>