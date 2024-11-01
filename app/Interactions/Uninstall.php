<?php

namespace TheBugTvaCore\Interactions;

use TheBugTvaCore\Contracts\Interactions\Uninstall as UninstallContract;

/**
 * The class that uninstalls and removes all database plugin related data.
 *
 * @since      1.0.0
 * @package    TheBugTvaCore
 * @subpackage TheBugTvaCore/Interactions
 * @author     Robert Cristian Chiribuc <robert.chiribuc@thebug.io>
 */
class Uninstall implements UninstallContract
{
    /**
     * Uninstall constructor.
     *
     * @since 1.0.0
     *
     * @param string $file
     *
     * @return void
     */
    public static function register($file)
    {
        register_uninstall_hook(
            $file,
            [
                Uninstall::class,
                'uninstall'
            ]
        );
    }

    /**
     * Removes all plugin related data.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function uninstall()
    {
        // no-op
    }
}
