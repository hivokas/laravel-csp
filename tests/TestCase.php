<?php

namespace Spatie\LaravelCsp\Tests;

use Spatie\LaravelCsp\CspServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelCsp\MiddleWare\CspHeaderMiddleware;

class TestCase extends Orchestra
{
    /** @var array */
    protected $config = [];

    public function setUp()
    {
        parent::setUp();

        $this->setupDummyRoutes();

        $this->config = $this->app['config']->get('csp');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');

        $app['config']->set('csp.default', 'strict');
    }

    protected function getPackageProviders($app)
    {
        return [
            CspServiceProvider::class,
        ];
    }

    public function setupDummyRoutes()
    {
        $this->app['router']->group(
            ['middleware' => CspHeaderMiddleware::class],
            function () {
                $this->app['router']->get('test', function () {
                    return 'Hello world!';
                });
            }
        );
    }
}
