<?php

namespace TheBugTvaCore\Contracts\Interactions;

/**
 * Interface Uninstall
 *
 * @package TheBugTvaCore\Contracts\Interactions
 */
interface Uninstall
{
    /**
     * Provides a method to register the uninstall hook.
     *
     * @param $file string The entry point of the plugin.
     *
     * @since 1.0.0
     */
    public static function register($file);

    /**
     * Provides a method to remove any data related with the plugin.
     *
     * @since 1.0.0
     */
    public static function uninstall();
}
