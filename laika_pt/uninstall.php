<?php
 // Check that code was called from WordPress with
 // uninstallation constant declared
 if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
 exit;
 // Check if options exist and delete them if present
 if ( get_option( 'laika_pt_generations' ) != false ) {
 delete_option( 'laika_pt_generations' );
 }
 if ( get_option( 'laika_pt_empty' ) != false ) {
 delete_option( 'laika_pt_empty' );
 }
 if ( get_option( 'laika_pt_default' ) != false ) {
 delete_option( 'laika_pt_default' );
 }
?>
