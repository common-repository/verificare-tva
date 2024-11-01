<?php

namespace TheBugTva\Development;

/**
 * Class Debug
 *
 * @package TheBugTva\Development
 */
class Debug
{
    /**
     * Display a variable's contents using nice HTML formatting and will
     * properly display the value of booleans as true or false
     *
     * @see dump_helper()
     *
     * @param  mixed $var the variable to dump
     *
     * @param bool   $exit
     *
     * @return string
     */
    public static function data($var, $exit = true)
    {
        $html = '<pre style="margin-bottom: 18px;' .
            'background: #f7f7f9;' .
            'border: 1px solid #e1e1e8;' .
            'padding: 8px;' .
            'display: block;' .
            'font-size: 12.10px;' .
            'white-space: pre-wrap;' .
            'word-wrap: break-word;' .
            'color: #333;' .
            'font-family: Menlo, Monaco, Consolas, \'Courier New\', monospace;">';

        list($debugFile) = debug_backtrace();
        if (!empty($debugFile['file'])) {
            $html .= '<h4 style="font-size: 14px;border-bottom:1px dashed #bdc3c7;color: #666;font-weight:bold;margin:0 0 10px 0;padding: 3px 0 10px 0"><span style="color: #f00;">FILE SOURCE:</span> ' . $debugFile['file'] . '</h4>';
        }
        $html .= self::dump_helper($var);
        $html .= '<p style="font-size: 10px;border-top:1px dashed #bdc3c7;color: #666;margin: 15px 0 0 0;padding: 8px 0"><span style="float: right;">PHP Version ' . phpversion() . '</span></p>';
        $html .= '</pre>';

        print $html;

        if ($exit) {
            exit;
        }
    }

    /**
     * Nice formatting dump
     *
     * @param  mixed $var the variable to dump
     *
     * @return string
     */
    protected static function dump_helper($var)
    {
        $html = '';

        switch ($var):
            case is_null('null'):
                $html .= ' <strong style="color: #e74c3c"><em>NULL</em></strong>';
                break;

            case is_bool($var):
                $html .= '<span style="color:#f39c12;">bool</span><span style="color:#999;">(</span>' . (($var) ? 'true' : 'false') . '<span style="color:#999;">)</span>';
                break;

            case is_int($var):
                $html .= '<span style="color:#f39c12;">int</span> <strong style="color: #e74c3c">' . $var . '</strong>';
                break;

            case is_float($var):
                $html .= '<span style="color:#f39c12;">float</span><span style="color:#999;">(</span><strong>' . $var . '</strong><span style="color:#999;">)</span>';
                break;

            case is_string($var):
                $html .= '<span style="color:#f39c12;">string</span><span style="color:#999;">(</span>' . strlen($var) . '<span style="color:#999;">)</span> <strong style="color: #e74c3c">"' . self::html_entities($var) . '"</strong>';
                break;

            case is_resource($var):
                $html .= '<span style="color:#f39c12;">resource</span><span style="color: #03A9F4">("' . get_resource_type($var) . '")</span> <strong style="color: #e74c3c">"' . $var . '"</strong>';
                break;

            case is_array($var):
                $html .= '<span style="color:#f39c12;">array</span><span style="color: #03A9F4">(' . count($var) . ')</span>';
                break;

            case is_object($var):
                $html .= ' <span style="color:#f39c12;">object</span><span style="color: #03A9F4">(' . get_class($var) . ')</span> <span><br />{<br />';
                break;
        endswitch;

        if (is_array($var)) {
            if (!empty($var)) {
                $html .= ' <span>{<br />';

                $indent    = 2;
                $keyLength = 0;

                foreach ($var as $key => $value) {
                    if (is_numeric($key)) {
                        $html .= str_repeat(' ', $indent) . str_pad($key, $keyLength, ' ');
                    } else {
                        $html .= str_repeat(' ',
                                $indent) . str_pad('<span style="color: #388E3C">"' . self::html_entities($key) . '"</span>',
                                $keyLength, ' ');
                    }

                    $html .= ' => ';

                    $value = explode('<br />', self::dump_helper($value));

                    foreach ($value as $line => $val) {
                        if ($line != 0) {
                            $value[$line] = str_repeat(' ', $indent * 2) . $val;
                        }
                    }

                    $html .= implode('<br />', $value) . '<br />';
                }

                $html .= '}</span>';
            }
        }

        if (is_object($var)) {
            $varArray  = (array)$var;
            $indent    = 2;
            $keyLength = 0;

            foreach ($varArray as $key => $value) {
                if (substr($key, 0, 2) == "\0*") {
                    unset($varArray[$key]);
                    $key            = 'protected:' . substr($key, 3);
                    $varArray[$key] = $value;
                } else if (substr($key, 0, 1) == "\0") {
                    unset($varArray[$key]);
                    $key            = 'private:' . substr($key, 1, strpos(substr($key, 1), "\0")) . ':' . substr($key,
                            strpos(substr($key, 1), "\0") + 2);
                    $varArray[$key] = $value;
                }
            }

            foreach ($varArray as $key => $value) {
                if (is_numeric($key)) {
                    $html .= str_repeat(' ', $indent) . str_pad($key, $keyLength, ' ');
                } else {
                    $html .= str_repeat(' ',
                            $indent) . str_pad('<span style="color: #388E3C">"' . self::html_entities($key) . '"</span>',
                            $keyLength, ' ');
                }

                $html .= ' => ';

                $value = explode('<br />', self::dump_helper($value));

                foreach ($value as $line => $val) {
                    if ($line != 0) {
                        $value[$line] = str_repeat(' ', $indent * 2) . $val;
                    }
                }

                $html .= implode('<br />', $value) . '<br />';
            }

            $html .= '}</span>';
        }

        return $html;
    }

    /**
     * Convert entities, while preserving already-encoded entities.
     *
     * @param  string $string The text to be converted
     *
     * @return string
     */
    protected static function html_entities($string)
    {
        return htmlentities($string, ENT_QUOTES, self::mb_internal_encoding());
    }

    /**
     * Wrapper to prevent errors if the user doesn't have the mbstring
     * extension installed.
     *
     * @param  string $encoding
     *
     * @return string
     */
    protected static function mb_internal_encoding($encoding = null)
    {
        if (function_exists('mb_internal_encoding')) {
            return $encoding ? mb_internal_encoding($encoding) : mb_internal_encoding();
        }

        return 'UTF-8';
    }
}
