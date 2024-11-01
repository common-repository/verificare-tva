<?php

namespace TheBugTvaCore\Services\Widgets\VatCheck;

use TheBugTvaCore\Contracts\Services\Widget as WidgetContract;
use WP_Widget;

/**
 * The class that defines and manages the Press Releases Company info.
 *
 * @since      1.0.0
 * @package    TheBugTvaCore
 * @subpackage TheBugTvaCore/Widgets/VatCheck
 * @author     Robert Cristian Chiribuc <robert.chiribuc@thebug.io>
 */
class VatCheck extends WP_Widget implements WidgetContract
{
    /**
     * Widget constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        parent::__construct(
            'verificare_tva',
            __('Verificare TVA', TVA_CORE_NAME),
            [
                'description' => __(
                    'Permite vizitatorilor să verifice informațiile TVA ale companiilor din România.',
                    TVA_CORE_NAME
                )
            ]
        );
    }

    /**
     * The widget form (for the backend).
     *
     * @since 1.0.0
     *
     * @param array $instance Form instance.
     *
     * @return void
     */
    public function form($instance)
    {
        // Set widget defaults
        $defaults = [
            'title' => ''
        ];

        // Parse current settings with defaults
        extract(wp_parse_args(( array )$instance, $defaults));

        include TVA_CORE_PATH . 'app/Views/admin/widgets/vat-check/view.php';
    }

    /**
     * Update widget settings
     *
     * @since 1.0.0
     *
     * @param array $newInstance
     * @param array $oldInstance
     *
     * @return array
     */
    public function update($newInstance, $oldInstance)
    {
        $instance = [
            'title' => $this->getNewInstance($newInstance['title'], true)
        ];

        return $instance;
    }

    /**
     * Get the new instance of input and strip tags.
     *
     * @since 1.0.0
     *
     * @param mixed   $input
     * @param boolean $strip
     *
     * @return bool|string
     */
    private function getNewInstance($input, $strip = false)
    {
        if ($strip) {
            return !empty($input) ? wp_strip_all_tags($input) : '';
        }

        return !empty($input);
    }

    /**
     * Public view for the widget.
     *
     * @since 1.0.0
     *
     * @param array $args
     * @param array $instance
     *
     * @return void
     */
    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';

        include_once TVA_CORE_PATH . 'app/Views/web/widgets/vat-check/view.php';
    }
}