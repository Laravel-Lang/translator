<?php

declare(strict_types=1);

namespace LaravelLang\Translator;

use DeepL\Translator;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\GoogleFree;
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
                options   : $app['config']->get('services.deepl.options', [])
            );
        });

        $this->app->singleton(GoogleFree::class, function (Application $app) {
            return new GoogleFree(
                translator: new GoogleTranslate(),
                options   : $app['config']->get('services.google_translate.options', []),
                preserve  : $app['config']->get('services.deepl.preserve_parameters') ?: true,
            );
        });

        $this->app->singleton(Yandex::class, function (Application $app) {
            return new Yandex(
                new YandexCloud(
                    key     : $app['config']->get('services.yandex.key'),
                    folderId: $app['config']->get('services.yandex.folder_id'),
                )
            );
        });
    }
}
