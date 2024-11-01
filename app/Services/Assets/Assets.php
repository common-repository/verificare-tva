<?php

namespace TheBugTvaCore\Services\Assets;

use TheBugTva\Register\Assets as AssetsParent;

/**
 * Registers the plugin assets.
 *
 * @since      1.0.0
 * @package    TheBugTvaCore
 * @subpackage TheBugTvaCore/Services/Assets
 * @author     Robert Cristian Chiribuc <robert.chiribuc@thebug.io>
 */
class Assets extends AssetsParent
{
    /**
     * Assets constructor.
     *
     * @since 1.0.0
     *
     * @param array $app The app instance
     */
    public function __construct($app)
    {
        parent::__construct($app['url']);
    }

    /**
     * Register plugin assets.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register()
    {
        // Register public script
        $this->registerScript(
            [
                'type'   => 'web',
                'handle' => TVA_CORE_NAME,
                'src'    => 'assets/web/js/app',
                'deps'   => ['jquery'],
                'footer' => true
            ]
        );

        // Register admin ajax script for retrieving VAT data from API.
        $this->registerScript(
            [
                'type'     => 'web',
                'handle'   => TVA_CORE_NAME,
                'localize' => [
                    'name' => 'vat_ajax',
                    'data' => [
                        'url'    => admin_url('admin-ajax.php'),
                        'action' => 'checkVat',
                        'type'   => 'check_vat',
                        'nonce'  => wp_create_nonce('check-vat')
                    ]
                ]
            ]
        );

        // Register public styles
        $this->registerStyle(
            [
                'type'   => 'web',
                'handle' => TVA_CORE_NAME,
                'src'    => 'assets/web/css/app',
            ]
        );
    }
}
