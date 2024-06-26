<?php

declare(strict_types=1);

namespace LaravelLang\Translator;

use DeepL\Translator;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;
use LaravelLang\Translator\Requests\YandexCloud;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(Deepl::class, function (Application $app) {
            return new Deepl(
                translator: new Translator($app['config']->get('services.deepl.key')),
            );
        });

        $this->app->singleton(Google::class, function (Application $app) {
            return new Google(
                translator: new GoogleTranslate(),
                regex     : $app['config']->get('services.google_translate.regex_parameters') ?: true,
            );
        });

        $this->app->singleton(Yandex::class, function (Application $app) {
            return new Yandex(
                new YandexCloud(
                    key     : $app['config']->get('services.yandex_translate.key'),
                    folderId: $app['config']->get('services.yandex_translate.folder_id'),
                )
            );
        });
    }
}
