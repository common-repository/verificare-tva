<?php

namespace TheBugTva\Core;

/**
 * Class WPUpdatePhp
 *
 * @package TheBugTva\Core
 */
class WPUpdatePhp
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
        if (version_compare($minimumVersion, PHP_VERSION, '<=')) {
            return true;
        }

        if (is_admin() && !defined('DOING_AJAX')) {
            add_action(
                'admin_notices',
                function() use ($minimumVersion) {
                    echo '<div class="error"><p>Unfortunately, the Quantum Newswire plugin can not run on PHP versions older than ' . $minimumVersion . '. Read more information about <a href="http://www.wpupdatephp.com/update/">how you can update</a>.</p></div>';
                }
            );
        }

        return false;
    }
}
