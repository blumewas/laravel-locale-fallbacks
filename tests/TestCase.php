<?php

namespace Blumewas\LaravelLocaleFallbacks\Tests;

use Blumewas\LaravelLocaleFallbacks\LaravelLocaleFallbacksServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelLocaleFallbacksServiceProvider::class,
        ];
    }

    protected function overrideApplicationProviders($app)
    {
        return [
            TranslationServiceProvider::class => LaravelLocaleFallbacksServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
