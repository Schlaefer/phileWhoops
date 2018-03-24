<?php

namespace Phile\Plugin\Siezi\PhileWhoops;

use Phile\ServiceLocator\ErrorHandlerInterface;

class ErrorLog implements ErrorHandlerInterface
{
    public function __construct(?string $logfile = null)
    {
        if ($logfile) {
            ini_set('error_log', $logfile);
        }
    }

    public function handleError(int $errno, string $errstr, ?string $errfile, ?string $errline)
    {
        $this->log($errno, $errstr, $errfile, $errline);
    }

    public function handleException(\Throwable $exception)
    {
        $code = (int)$exception->getCode();
        $message = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $this->log($code, $message, $file, $line);
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        exit;
    }

    public function handleShutdown()
    {
        $error = error_get_last();
        if ($error === null) {
            return;
        }
        $this->log($error['type'], $error['message'], $error['file'], $error['line']);
    }

    protected function log(int $code, string $message, ?string $file, ?string $line): void
    {
        error_log("[{$code}] {$message} in {$file} on line {$line}");
    }
}
