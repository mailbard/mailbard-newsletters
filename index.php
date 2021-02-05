<?php
/*
Plugin Name: MailBard Newsletters
Plugin URI: http://www.mailbard.com/
Description: Create and send newsletters or automated emails. Capture subscribers with a widget. Import and manage your lists. This plugin was forked from MailPoet 2 (no longer maintained), by the MailPoet team (http://www.mailpoet.com/).  MailBard is not affiliated with MailPoet.
Version: 0.2.0
License: GPLv2 or later
Text Domain: mailbard
Domain Path: /languages/
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Not allowed' );
}

define( 'MAILBARD_URL', plugins_url( '', __FILE__ ).'/' );


add_action( 'plugins_loaded', 'mailbard_loader' );

function mailbard_loader() {
	if ( defined( 'WYSIJA' ) ) {
		// throw warning
		add_action( 'admin_notices', 'mailbard_wysija_warning' );
	} else {
	
		// load legacy code
		require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'legacy'.DIRECTORY_SEPARATOR.'index.php');
		
		// load additional new code here
		require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'mailbard-ajax.php');
		
	}
}

function mailbard_wysija_warning() {
	?>
	<div class="notice error">
		<p><?php printf( __( 'MailBard cannot run while MailPoet 2 is still activated.  Please go to your <a href="%s">Plugins</a> page and de-activate MailPoet 2 now.  Don\'t worry, you won\'t lose any data, and MailBard will pick up right where you left off!', 'mailbard' ), admin_url('plugins.php') ); ?></p>
	</div>
	<?php
}

// to maintain compatibility for old MailPoet extensions:
if ( ! function_exists( 'wysija_is_plg_active' ) ){
	function wysija_is_plg_active( $filename ){
		if ( $filename === 'wysija-newsletters/index.php' ) {
			return true;
		}
		$arrayactiveplugins = get_option( 'active_plugins' );
		if ( in_array( $filename, $arrayactiveplugins ) ){
			return true;
		}
		if ( is_multisite() ) {
			$arrayactiveplugins = get_site_option( 'active_sitewide_plugins' );
			if ( isset( $arrayactiveplugins[ $filename ] ) || in_array( $filename, $arrayactiveplugins ) ){
				return true;
			}
		}
		return false;
	}
}
