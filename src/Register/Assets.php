<?php

namespace TheBugTva\Register;

use TheBugTva\Contract\Register\Assets as AssetsContract;

/**
 * Class Assets
 *
 * @package TheBugTva\Register
 */
class Assets implements AssetsContract
{
    /**
     * Registration hooks for all assets.
     *
     * @var array
     */
    public $actions = [
        [
            'hook'   => 'wp_loaded',
            // @todo revisit this requirement
            'method' => 'register'
        ],
        [
            'hook'     => 'wp_enqueue_scripts',
            'method'   => 'enqueueWebScripts',
            'priority' => 11
        ],
        [
            'hook'   => 'wp_enqueue_scripts',
            'method' => 'enqueueWebStyles'
        ],
        [
            'hook'   => 'admin_enqueue_scripts',
            'method' => 'enqueueAdminScripts'
        ],
        [
            'hook'   => 'admin_enqueue_scripts',
            'method' => 'enqueueAdminStyles'
        ]
    ];
    /**
     * Url to the plugin directory.
     *
     * @var string
     */
    protected $url;

    /**
     * Minification string for enqueued assets.
     *
     * @var string
     */
    private $min = '';

    /**
     * Array of script definition arrays.
     *
     * @var array
     */
    private $scripts = [];

    /**
     * Array of style definition arrays.
     *
     * @var array
     */
    private $styles = [];

    /**
     * @inheritDoc
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function enqueueAdminScripts()
    {
        foreach ($this->scripts as $script) {
            if (in_array($script['type'],
                         [
                             'admin',
                             'shared'
                         ]
            )) {
                $this->enqueueScript($script);
            }
        }
    }

    /**
     * Enqueues an individual script if the script's condition is met.
     *
     * @param array $script
     */
    protected function enqueueScript($script)
    {
        if (isset($script['localize'])) {
            wp_localize_script(
                $script['handle'],
                $script['localize']['name'],
                $script['localize']['data']
            );
        } else {
            wp_enqueue_script(
                $script['handle'],
                $this->url . $script['src'] . '.js',
                isset($script['deps']) ? $script['deps'] : [],
                null, // @todo implement version
                isset($script['footer']) ? $script['footer'] : false
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function enqueueAdminStyles()
    {
        foreach ($this->styles as $style) {
            if (in_array($style['type'],
                         [
                             'admin',
                             'shared'
                         ]
            )) {
                $this->enqueueStyle($style);
            }
        }
    }

    /**
     * Enqueues an individual stylesheet if the style's condition is met.
     *
     * @param array $style
     */
    protected function enqueueStyle($style)
    {
        wp_enqueue_style(
            $style['handle'],
            $this->url . $style['src'] . '.css',
            isset($style['deps']) ? $style['deps'] : [],
            null, // @todo implement version
            isset($style['media']) ? $style['media'] : 'all'
        );
    }

    /**
     * @inheritDoc
     */
    public function enqueueWebScripts()
    {
        foreach ($this->scripts as $script) {
            if (in_array($script['type'],
                         [
                             'web',
                             'shared'
                         ]
            )) {
                $this->enqueueScript($script);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function enqueueWebStyles()
    {
        foreach ($this->styles as $style) {
            if (in_array($style['type'],
                         [
                             'web',
                             'shared'
                         ]
            )) {
                $this->enqueueStyle($style);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function registerScript($script)
    {
        $this->scripts[] = $script;
    }

    /**
     * @inheritdoc
     */
    public function registerStyle($style)
    {
        $this->styles[] = $style;
    }

    /**
     * @inheritdoc
     */
    public function setDebug($debug)
    {
        if ($debug) {
            $this->min = '.min';
        } else {
            $this->min = '';
        }
    }

    /**
     * Registers all the scripts at runtime after WordPress is loaded.
     *
     * This function is intended to be overwritten by the child class. The developer
     * should use this to define the scripts they'd like to have registered. The
     * assets cannot be defined in the object's properties because a Closure cannot
     * be defined there, so it must be defined at runtime.
     *
     * Since this is a no-op by default, we don't need to test and is ignored by
     * the coverage report generated by PHPUnit.
     *
     * @codeCoverageIgnore
     */
    public function register()
    {
        // no-op
    }
}
