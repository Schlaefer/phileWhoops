<?php

namespace Phile\Plugin\Siezi\PhileWhoops;

use Phile\Core\ServiceLocator;
use Phile\Plugin\AbstractPlugin;
use Phile\ServiceLocator\ErrorHandlerInterface;

class Plugin extends AbstractPlugin
{
    protected $events = ['plugins_loaded' => 'onPluginsLoaded'];

    protected $settings = [
        'editor' => null,
        'level' => -1
    ];

    public function onPluginsLoaded()
    {
        $handler = new Development($this->settings);
        ServiceLocator::registerService('Phile_ErrorHandler', $handler);
    }
}
