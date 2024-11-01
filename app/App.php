<?php

namespace TheBugTvaCore;

use TheBugTva\Core\Application;
use TheBugTvaCore\Services\Assets\Assets;
use TheBugTvaCore\Services\Web\Web;
use TheBugTvaCore\Services\Widgets\Widgets;

/**
 * Plugin's Application class.
 *
 * The main Application class holds all the plugin's Services and registers
 * them with the Loader, hooking them into WordPress's actions and filters.
 * Those Services can be registered array-like with a Closure:
 *
 * ```php
 * $this['ServiceName'] = function ($app) {
 *     return new ServiceName($app['ServiceDep']);
 * };
 *
 * $this['ServiceDep'] = function () {
 *     return new ServiceDep();
 * };
 * ```
 *
 * The Application class's parent constructor also initializes several properties
 * in the Application container, including:
 *
 * * 'url': result of plugin_dir_url
 * * 'path: result of plugin_dir_path
 * * 'basename': result of plugin_basename
 *
 * as well registering a built-in I18n class and the Loader. Finally, it registers
 * plugin de/activation hooks on the method `activate`, `deactivate` and `uninstall`
 * on the class.
 * Those methods are stubbed for you as part of the bootstrapping.
 *
 * An internal method is also exposed, `command`, to ease registration of WP-CLI
 * commands. `command`'s method signature matches `WP_CLI::add_command`, but the
 * second param is a Closure in the same style as the above Service registration.
 *
 * @since      1.0.0
 * @package    TheBugTvaCore
 * @author     Robert Cristian Chiribuc <robert.chiribuc@thebug.io>
 */
class App extends Application
{
    /**
     * App Constructor.
     *
     * @param string $file
     */
    public function __construct($file)
    {
        parent::__construct($file);

        $this['Web'] = function() {
            return new Web();
        };

        $this['Assets'] = function($app) {
            return new Assets($app);
        };

        $this['Widgets'] = function() {
            return new Widgets();
        };
    }

    /**
     * Fired on plugin activation.
     *
     * @since 1.0.0
     */
    public function activate()
    {
        // no-op
    }

    /**
     * Fired on plugin deactivation.
     *
     * @since 1.0.0
     */
    public function deactivate()
    {
        // no-op
    }
}
