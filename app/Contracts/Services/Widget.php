<?php

namespace TheBugTvaCore\Contracts\Services;

/**
 * Interface Widget
 *
 * @package TheBugTvaCore\Contracts\Services
 */
interface Widget
{
    /**
     * Inherits the WP_Widget parent constructor.
     *
     * @since 1.0.0
     */
    public function __construct();

    /**
     * Provides a method to build the widget form.
     *
     * @param $instance array The form instance.
     *
     * @since 1.0.0
     */
    public function form($instance);

    /**
     * Provides a method to update the form data upon save.
     *
     * @param $newInstance array The new form instance data.
     * @param $oldInstance array The old form instance data.
     *
     * @since 1.0.0
     */
    public function update($newInstance, $oldInstance);

    /**
     * Provides a method to build the public view of the widget.
     *
     * @param $args     array The widget arguments.
     * @param $instance array The saved form values from database.
     *
     * @since 1.0.0
     */
    public function widget($args, $instance);
}
