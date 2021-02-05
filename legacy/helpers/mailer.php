<?php
defined( 'WYSIJA' ) || die( 'Restricted access' );

if ( version_compare( get_bloginfo( 'version' ), '5.5.0', '>=' ) ) {
	require_once ABSPATH . WPINC . '/PHPMailer/PHPMailer.php';
	require_once dirname( __FILE__ ) . '/mailer-5.5.php';
} else {
	require_once ABSPATH . WPINC . '/class-phpmailer.php';
	require_once dirname( __FILE__ ) . '/mailer-original.php';
}
