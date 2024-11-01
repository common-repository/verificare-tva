<?php

namespace TheBugTva\Core;

/**
 * Class WPUpdate
 *
 * @package TheBugTva\Core
 */
class WPUpdate
{
    /**
     * Loads the app or displays admin notice
     *
     * @param $minimumVersion
     *
     * @return bool
     */
    public static function check($minimumVersion)
    {
        global $wp_version;

        if (version_compare($minimumVersion, $wp_version, '<=')) {
            return true;
        }

        if (is_admin() && !defined('DOING_AJAX')) {
            add_action(
                'admin_notices',
                function() use ($minimumVersion) {
                    echo '<div class="error"><p>Unfortunately, the Quantum Newswire plugin can not run on WordPress versions older than ' . $minimumVersion . '. Read more information about <a href="https://codex.wordpress.org/Upgrading_WordPress">how you can update</a>.</p></div>';
                }
            );
        }

        return false;
    }
}
