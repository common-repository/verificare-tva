<?php

namespace TheBugTvaCore\Contracts\Interactions;

/**
 * Interface ImportData
 *
 * @package TheBugTvaCore\Contracts\Interactions
 */
interface ImportData
{
    /**
     * Provides a method to import the external data into WordPress database.
     *
     * @param $data array Contains an array with items to be imported.
     *
     * @since 1.0.0
     */
    public static function import($data);
}
