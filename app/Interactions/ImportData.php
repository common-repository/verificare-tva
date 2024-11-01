<?php

namespace TheBugTvaCore\Interactions;

use TheBugRomania\Anaf\TVA;
use TheBugTvaCore\Contracts\Interactions\ImportData as ImportDataContract;

/**
 * The class that handles the import and data method.
 *
 * @since      1.0.0
 * @package    TheBugTvaCore
 * @subpackage TheBugTvaCore/core/Import
 * @author     Robert Cristian Chiribuc <robert.chiribuc@thebug.io>
 */
class ImportData implements ImportDataContract
{
    /**
     * This method handles API request to check company data.
     *
     * @since 1.0.0
     *
     * @param array $data
     *
     * @return array
     * @throws \TheBugRomania\Exceptions\CuiLimitException
     * @throws \TheBugRomania\Exceptions\InvalidCuiException
     * @throws \TheBugRomania\Exceptions\InvalidDateFormatException
     */
    public static function import($data)
    {
        $results = TVA::check()->one((int)$data['data']['cui'], $data['data']['date'])->results();

        // Decode the result
        $results = json_decode($results);

        return $results->found[0];
    }
}
