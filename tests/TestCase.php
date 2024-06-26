<?php

namespace Tests;

use Illuminate\Config\Repository;
use LaravelLang\Translator\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        tap($app['config'], function (Repository $config) {
            $config->set('services.deepl.key', 'foo');

            $config->set('services.yandex_translate.key', 'foo');
            $config->set('services.yandex_translate.folder_id', 'bar');
        });
    }
}
