<?php

declare(strict_types=1);

namespace LaravelLang\Translator;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelLang\Config\Data\Shared\TranslatorData;
use LaravelLang\Config\Facades\Config;
use LaravelLang\Translator\Contracts\Translator;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        foreach ($this->translators() as $config) {
            $this->bootTranslator($config->translator, $config->credentials);
        }
    }

    protected function bootTranslator(string|Translator $translator, array $credentials): void
    {
        $this->app->singleton($translator, fn () => new $translator(
            new $translator::$integration(...$credentials)
        ));
    }

    /**
     * @return array<TranslatorData>
     */
    protected function translators(): array
    {
        return Config::shared()->translators->enabled;
    }
}
