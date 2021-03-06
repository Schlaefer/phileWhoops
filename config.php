<?php

use Phile\Plugin\Siezi\PhileWhoops\Plugin;

return [
    /**
     * [error_log|development]
     */
    'handler' => Plugin::HANDLER_ERROR_LOG,
    /**
     * - null: use default PHP error.log
     * - string: path to custom error.log
     */
    'error_log_file' => null 
];
