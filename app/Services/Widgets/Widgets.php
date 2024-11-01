<?php

namespace TheBugTvaCore\Services\Widgets;

use TheBugTvaCore\Contracts\Services\Widgets as WidgetsContract;
use TheBugTvaCore\Services\Widgets\VatCheck\VatCheck;

/**
 * This class manages widgets registration.
 *
 * @since      1.0.0
 * @package    TheBugTvaCore
 * @subpackage TheBugTvaCore/Services/Widgets
 * @author     Robert Cristian Chiribuc <robert.chiribuc@thebug.io>
 */
class Widgets implements WidgetsContract
{
    /**
     * Action hooks for the widgets service.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $actions = [
        [
            'hook'   => 'widgets_init',
            'method' => 'registerWidgets'
        ]
    ];

    /**
     * Register all plugin widgets.
     *
     * For all widgets registered here you need to add delete_option() in the uninstall class.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function registerWidgets()
    {
        // Releases list widget
        register_widget(VatCheck::class);
    }
}
