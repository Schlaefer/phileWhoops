<?php

namespace Phile\Plugin\Siezi\PhileWhoops\Tests;

use Phile\Core\Config;
use Phile\Test\TestCase;

class PluginTest extends TestCase
{
    /**
     * Basic test that whoops plugin is running.
     *
     * The exception is not thrown but caught by Whoops and rendered plaintext
     * CLI response.
     */
    public function testWhoops()
    {
        $config = new Config([
            'plugins' => [
                'siezi\\phileWhoops' => ['active' => true, 'handler' => 'development']
            ]
        ]);
        $eventBus = new \Phile\Core\Event;
        $eventBus->register('after_init_core', function () {
            throw new \Exception('1845F098-9035-4D8E-9E31');
        });

        $request = $this->createServerRequestFromArray();

        try {
            $core = $this->createPhileCore($eventBus, $config);
            $response = $this->createPhileResponse($core, $request);
        } catch (\Exception $e) {
            ob_start();
            $errorHandler = \Phile\Core\ServiceLocator::getService(
                'Phile_ErrorHandler'
            );
            $errorHandler->handleException($e);
            $body = ob_get_clean();
        }

        $this->assertStringStartsWith('Exception: 1845F098-9035-4D8E-9E31', $body);
    }
}
