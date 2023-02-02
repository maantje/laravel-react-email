<?php

use Maantje\ReactEmail\ReactEmailServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ReactEmailServiceProvider::class
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('react-email.template_directory', __DIR__ . '/emails/');
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app->setBasePath(__DIR__ . '/..');
    }
}
