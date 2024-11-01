<?php

namespace TheBugTva\Register;

use TheBugTva\Contract\Register\I18n as I18nContract;

/**
 * Class I18n
 *
 * @package TheBugTva\Register
 */
class I18n implements I18nContract
{

    /**
     * Action hooks for the I18n service.
     *
     * @var array
     */
    public $actions = [
        [
            'hook'   => 'after_setup_theme',
            'method' => 'loadTranslation',
        ]
    ];
    /**
     * Plugin path
     *
     * @var string
     */
    private $path;

    /**
     * @inheritdoc
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function loadTranslation()
    {
        load_plugin_textdomain(
            basename($this->path),
            false,
            basename($this->path) . '/languages/'
        );
    }
}
