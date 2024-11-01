<?php

use TheBugTva\Development\Debug;

// ----------------------------------------------------------------------------
if (WP_DEBUG && !function_exists('debug')) {
    /**
     * Wrapper for prettier var dumping
     *
     * @param mixed   $data
     * @param boolean $exit
     *
     * @since 1.0.0
     *
     * @return string
     */
    function debug($data, $exit = true)
    {
        return Debug::data($data, $exit);
    }
}
// ----------------------------------------------------------------------------
