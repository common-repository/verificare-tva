<?php

namespace TheBugTva\Contract\Core;

use TheBugTva\Contract\Core\Container as ContainerContract;

/**
 * Interface Loader
 *
 * @package TheBugTva\Contract\Core
 */
interface Loader
{
    /**
     * Instantiate a new Loader instance.
     *
     * The Loader requires a Container to load from, which according to its contract,
     * will be both accessible via ArrayAccess (`$container['key']`) as well as
     * Iterable through a foreach loop. This is used by the Loader to register
     * the Container's services with WordPress.
     *
     * @param ContainerContract $container
     */
    public function __construct(ContainerContract $container);

    /**
     * Registers the Application Services with their relevant hooks.
     *
     * Loops through all the services, checks for the presence of
     * an `actions` or `filters` property on each service, and, if present,
     * registers the declared actions and filters with WordPress.
     */
    public function register();

    /**
     * Register all the actions and filters with WordPress.
     *
     * Loops through all the registered actions/filters and fires add_* for each of
     * them respectively.
     */
    public function run();
}
