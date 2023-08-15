<?php
/**
 * Plugin Name: PublishPress Blocks
 * Plugin URI: https://publishpress.com/blocks/
 * Description: PublishPress Blocks has everything you need to build professional websites with the Gutenberg editor.
 * Version: 3.1.6
 * Author: PublishPress
 * Author URI: https://publishpress.com/
 * Text Domain: advanced-gutenberg
 * Domain Path: /languages
 * Requires at least: 5.5
 * Requires PHP: 7.2.5
 * License: GPL2
 */

/**
 * Copyright
 *
 * @copyright 2014-2020  Joomunited
 * @copyright 2020       Advanced Gutenberg. help@advancedgutenberg.com
 * @copyright 2020-2023  PublishPress. help@publishpress.com
 *
 *  Original development of this plugin was kindly funded by Joomunited
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

defined('ABSPATH') || die;

global $wp_version;

$min_php_version = '7.2.5';
$min_wp_version  = '5.5';

// If the PHP or WP version is not compatible, terminate the plugin execution.
$invalid_php_version    = version_compare(phpversion(), $min_php_version, '<');
$invalid_wp_version     = version_compare($wp_version, $min_wp_version, '<');

if ($invalid_php_version || $invalid_wp_version) {
    return;
}

$includeFilebRelativePath = '/publishpress/instance-protection/include.php';
if (file_exists(__DIR__ . '/lib/vendor' . $includeFilebRelativePath)) {
    require_once __DIR__ . '/lib/vendor' . $includeFilebRelativePath;
} else if (defined('ADVANCED_GUTENBERG_LIB_VENDOR_PATH') && file_exists(ADVANCED_GUTENBERG_LIB_VENDOR_PATH . $includeFilebRelativePath)) {
    require_once ADVANCED_GUTENBERG_LIB_VENDOR_PATH . $includeFilebRelativePath;
}

if (class_exists('PublishPressInstanceProtection\\Config')) {
    $pluginCheckerConfig = new PublishPressInstanceProtection\Config();
    $pluginCheckerConfig->pluginSlug = 'advanced-gutenberg';
    $pluginCheckerConfig->pluginName = 'PublishPress Blocks';

    $pluginChecker = new PublishPressInstanceProtection\InstanceChecker($pluginCheckerConfig);
}

if (! defined('ADVANCED_GUTENBERG_LOADED')) {

    if (! defined('ADVANCED_GUTENBERG_VERSION')) {
        define('ADVANCED_GUTENBERG_VERSION', '3.1.6');
    }

    if (! defined('ADVANCED_GUTENBERG_PLUGIN')) {
        define('ADVANCED_GUTENBERG_PLUGIN', __FILE__);
    }

    if ( ! defined( 'ADVANCED_GUTENBERG_BASE_PATH' ) ) {
        define( 'ADVANCED_GUTENBERG_BASE_PATH', __DIR__ );
    }

    /**
     * @since 3.2.0
     */
    if ( ! defined( 'ADVANCED_GUTENBERG_LIB_VENDOR_PATH' ) ) {
        define( 'ADVANCED_GUTENBERG_LIB_VENDOR_PATH', ADVANCED_GUTENBERG_BASE_PATH . '/lib/vendor' );
    }

    /**
     * @deprecated 3.2.0 Use ADVANCED_GUTENBERG_LIB_VENDOR_PATH instead.
     */
    if ( ! defined( 'ADVANCED_GUTENBERG_VENDOR_PATH' ) ) {
        define( 'ADVANCED_GUTENBERG_VENDOR_PATH', ADVANCED_GUTENBERG_LIB_VENDOR_PATH );
    }

    // Internal Vendor and Ask-for-Review
    $autoloadFilePath = ADVANCED_GUTENBERG_LIB_VENDOR_PATH . '/autoload.php';
    if ( ! class_exists('ComposerAutoloaderInitPPBlocks' )
        && is_file( $autoloadFilePath )
        && is_readable( $autoloadFilePath )
        && ! defined( 'ADVANCED_GUTENBERG_LIB_VENDOR_LOADED' )
        && is_admin()
        && ! class_exists( 'PublishPress\WordPressReviews\ReviewsController' )
    ) {
        require_once $autoloadFilePath;
        define( 'ADVANCED_GUTENBERG_LIB_VENDOR_LOADED', true );

        // Ask for review
        if( file_exists( __DIR__ . '/review/review-request.php' ) ) {
            require_once __DIR__ . '/review/review-request.php';
        }

        // Display ads for Pro version
        if ( ! defined( 'PP_VERSION_NOTICES_LOADED' ) ) {
            $noticesPath = __DIR__ . '/lib/vendor/publishpress/wordpress-version-notices/includes.php';
            if ( file_exists( $noticesPath ) ) {
                require_once $noticesPath;
            }
        }
    }

    // Code shared with Pro version
    require_once __DIR__ . '/init.php';

    define('ADVANCED_GUTENBERG_LOADED', true);
}
