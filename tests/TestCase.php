<?php

namespace Tests;

use Illuminate\Config\Repository;
use LaravelLang\Config\Enums\Name;
use LaravelLang\Config\ServiceProvider as ConfigServiceProvider;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;
use LaravelLang\Translator\ServiceProvider as TranslatorServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            TranslatorServiceProvider::class,
            ConfigServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        tap($app['config'], function (Repository $config) {
            $config->set(Name::Shared() . '.translators.google.translator', Google::class);
            $config->set(Name::Shared() . '.translators.google.credentials.key', 'foo');

            $config->set(Name::Shared() . '.translators.deepl.translator', Deepl::class);
            $config->set(Name::Shared() . '.translators.deepl.credentials.key', 'foo');

            $config->set(Name::Shared() . '.translators.yandex.translator', Yandex::class);
            $config->set(Name::Shared() . '.translators.yandex.credentials.key', 'foo');
            $config->set(Name::Shared() . '.translators.yandex.credentials.folter', '123');
        });
    }
}
