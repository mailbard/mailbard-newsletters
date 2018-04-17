<?php
/*
Plugin Name: MailBard
Plugin URI: http://www.mailbard.com/
Description: Create and send newsletters or automated emails. Capture subscribers with a widget. Import and manage your lists. This plugin was forked from MailPoet 2 (no longer maintained), by the MailPoet team (http://www.mailpoet.com/).  MailBard is not affiliated with MailPoet.
Version: 0.1.0
Author: MailBard
Author URI: http://www.mailbard.com/
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

if ( class_exists( 'WYSIJA_object' ) ) {
	// throw warning
	add_action( 'admin_notices', 'mailbard_wysija_warning' );
} else {
	// load
	require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'legacy'.DIRECTORY_SEPARATOR.'index.php');
}

function mailbard_wysija_warning() {
	?>
	<div class="notice error">
		<p><?php printf( __( 'MailBard cannot run while MailPoet 2 is still activated.  Please go to your <a href="%s">Plugins</a> page and de-activate it now.  Don\'t worry, you won\'t lose any data, and MailBard will pick up right where MailPoet 2 left off!', 'mailbard' ), plugins_url() ); ?></p>
	</div>
	<?php
}
