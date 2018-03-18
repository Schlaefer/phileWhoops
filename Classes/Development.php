<?php

namespace Phile\Plugin\Siezi\PhileWhoops;

use Phile\ServiceLocator\ErrorHandlerInterface;
use Whoops\Handler\Handler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;

class Development implements ErrorHandlerInterface
{
    protected $events = [
        'plugins_loaded' => 'onPluginsLoaded'
    ];

    protected $settings;

    protected $whoops;

    public function __construct(array $settings = [])
    {
        $this->settings = $settings;
        $this->whoops = new \Whoops\Run();
        $this->whoops->pushHandler($this->createHandler());
    }

    public function handleError(int $errno, string $errstr, ?string $errfile, ?string $errline)
    {
        $level = $this->settings['level'];
        $this->whoops->{\Whoops\Run::ERROR_HANDLER}($level, $errstr, $errfile, $errline);
    }

    public function handleException(\Throwable $exception)
    {
        $this->whoops->{\Whoops\Run::EXCEPTION_HANDLER}($exception);
    }

    public function handleShutdown()
    {
        $this->whoops->{\Whoops\Run::SHUTDOWN_HANDLER}();
    }

    protected function createHandler(): Handler
    {
        if (PHILE_CLI_MODE) {
            $handler = new PlainTextHandler;
            $this->whoops->allowQuit(false);
            return $handler;
        }

        $handler = new PrettyPageHandler;
        if (!empty($this->$settings['editor'])) {
            $handler->setEditor($this->settings['editor']);
        }
        return $handler;
    }
}
