<?php

namespace TheBugTvaCore\Services\Web;

use TheBugRomania\Exceptions\CuiLimitException;
use TheBugRomania\Exceptions\InvalidCuiException;
use TheBugRomania\Exceptions\InvalidDateFormatException;
use TheBugTvaCore\Interactions\ImportData;

/**
 * The public-specific functionality of the plugin.
 *
 * @since      1.0.0
 * @package    TheBugTvaCore
 * @subpackage TheBugTvaCore/Services/Web
 * @author     Robert Cristian Chiribuc <robert.chiribuc@thebug.io>
 */
class Web
{
    /**
     * Action hooks for the Web service.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $actions = [
        [
            'hook'   => 'wp_ajax_checkVat',
            'method' => 'checkVat'
        ]
    ];

    /**
     * The plugin path.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $path;

    /**
     * Web constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->path = TVA_CORE_PATH;
    }

    /**
     * Handles VAT check requests.
     *
     * @since 1.0.0
     *
     * return array
     */
    public function checkVat()
    {
        if (isset($_POST['type']) && $_POST['type'] === 'check_vat' && isset($_POST['_nonce']) && wp_verify_nonce(
                $_POST['_nonce'],
                'check-vat'
            )) {


            try {
                $response = ImportData::import($_POST);

                include_once $this->path . 'app/Views/web/widgets/vat-check/response.php';
            } catch (CuiLimitException $e) {
                echo $e->getMessage();
            } catch (InvalidCuiException $e) {
                echo '<span class="vat-false">Codul CUI nu este valid!</span>';
            } catch (InvalidDateFormatException $e) {
                echo $e->getMessage();
            }
        }

        exit;
    }
}
