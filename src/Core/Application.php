<?php

namespace TheBugTva\Core;

use Closure;
use TheBugTva\Contract\Core\Application as ApplicationContract;
use TheBugTva\Exceptions\ApplicationAlreadyBootedException;
use TheBugTva\Exceptions\ApplicationNotBootedException;
use TheBugTva\Register\I18n;

/**
 * Class Application
 *
 * @package TheBugTva\Core
 */
class Application extends Container implements ApplicationContract
{
    /**
     * Singleton instance of the Application object
     *
     * @var Application
     */
    protected static $instance = null;

    /**
     * @inheritDoc
     */
    public function __construct($file)
    {
        if (static::$instance !== null) {
            throw new ApplicationAlreadyBootedException;
        }

        static::$instance = $this;

        $this['url']      = plugin_dir_url($file);
        $this['path']     = plugin_dir_path($file);
        $this['basename'] = plugin_basename($file);

        $this['I18n'] = function($app) {
            return new I18n($app['path']);
        };

        $this['Loader'] = function($app) {
            return new Loader($app);
        };

        register_activation_hook($file, [$this, 'activate']);
        register_deactivation_hook($file, [$this, 'deactivate']);
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function activate()
    {
        // no-op
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function boot()
    {
        $this['Loader']->register();
    }

    /**
     * Registers a command with WP-CLI.
     *
     * This is a helper function for registering commands. The first parameter is the command name
     * as you would normally register with WP-CLI. The second parameter should be a closure that
     * returns the class to register with WP-CLI. This cleans up some of the boilerplate required
     * to register commands as well as make WP-CLI command classes injectable.
     *
     * @param string  $name
     * @param Closure $class
     */
    public function command($name, Closure $class)
    {
        // TODO: Implement command() method.
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function deactivate()
    {
        // no-op
    }

    /**
     * @inheritDoc
     *
     * @return \TheBugTva\Core\Application
     */
    public static function get()
    {
        if (static::$instance === null) {
            throw new ApplicationNotBootedException;
        }

        return static::$instance;
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public static function shutdown()
    {
        if (static::$instance !== null) {
            static::$instance = null;
        }
    }
}
