<?php

namespace Phile\Plugin\Siezi\PhileWhoops;

use Phile\Core\ServiceLocator;
use Phile\Plugin\AbstractPlugin;

class Plugin extends AbstractPlugin
{
    public const HANDLER_ERROR_LOG = 'error_log';

    public const HANDLER_DEVELOPMENT = 'development';

    protected $events = ['plugins_loaded' => 'registerErrorHandler'];

    protected $settings = [
        'handler' => self::HANDLER_DEVELOPMENT,
        'editor' => null,
        'level' => -1
    ];

    public function registerErrorHandler()
    {
        switch ($this->settings['handler']) {
            case Plugin::HANDLER_DEVELOPMENT:
                $handler = new Development($this->settings);
                break;
            case Plugin::HANDLER_ERROR_LOG:
                $handler = new ErrorLog;
                break;
            default:
                return;
        }
        ServiceLocator::registerService('Phile_ErrorHandler', $handler);
    }
}
