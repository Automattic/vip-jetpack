<?php

/*
 * Plugin Name: Jetpack: VIP Specific Changes
 * Plugin URI: https://github.com/Automattic/vipv2-mu-plugins/blob/master/jetpack-mandatory.php
 * Description: VIP-specific customisations to Jetpack.
 * Author: Automattic
 * Version: 1.0
 * License: GPL2+
 */

/**
 * Remove certain modules from the list of those that can be activated
 * Blocks access to certain functionality that isn't compatible with the platform.
 */
add_filter( 'jetpack_get_available_modules', function( $modules ) {
	unset( $modules['sitemaps'] ); // Duplicates msm-sitemaps and doesn't scale for our client's needs (https://github.com/Automattic/jetpack/issues/3314)

	return $modules;
}, 999 );

/**
 * Enable VIP modules required as part of the platform
 */
require_once( __DIR__ . '/jetpack-mandatory.php' );

/**
 * On VIP Go, we always want to use the Go Photon service, instead of WordPress.com's
 */
add_filter( 'jetpack_photon_domain', function( $domain, $image_url ) {
	return home_url();
}, 2, 9999 );

/**
 * Front-end SSL is support on VIP Go and in our file service,
 * and Jetpack's Photon module should respect that.
 */
add_filter( 'jetpack_photon_reject_https', '__return_false' );
