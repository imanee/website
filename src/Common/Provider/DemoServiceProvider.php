<?php
/**
 * Loads Demos metadata
 */

namespace Little\Common\Provider;

use Little\Common\Demo\DemoLoader;
use Silex\Application;
use Silex\ServiceProviderInterface;

class DemoServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $app['demos.loader'] = function($app) {
            return new DemoLoader($app['demos.path']);
        };
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }

    public function getLoader()
    {

    }
}
