
<?php
/*
Plugin Name: Only Allow Administrators
Description: Only Allow Administrators is a simple and useful plugin. Without Administrators user, nobody can't log in your WordPress dashboard.
Version: 1.0
Author: Sumon Hasan
Author URI: https://sumonhasan.com/
Plugin URI: https://sumonhasan.com/only-allow-administrators/
License: GPLv2 or later
Text Domain: only-allow-administrators
*/

defined('ABSPATH') or die("Cannot access pages directly.");

add_action( 'admin_init', 'wordpress_only_allow_administrators_sh');

function wordpress_only_allow_administrators_sh() {

      if( defined('DOING_AJAX') && DOING_AJAX ) {
            //Allow ajax calls
            return;
      }

      $user = wp_get_current_user();
			// Redirect If Not Logged In
			if (!in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) && !is_admin() && !is_user_logged_in()) {
				 if(is_page(155) || is_page(200)){
					
				 }else{
				auth_redirect();
				 }

			 }

			// check user role
      if( empty( $user ) || !in_array( "administrator", (array) $user->roles ) ) {
           wp_die( sprintf( __( 'Sorry you are not allowed to access admin dashboard. <a href="%s">Logout?</a>', 'only-allow-administrators' ), wp_logout_url(home_url()) ) );
           exit();
      }
	  
 }
	
